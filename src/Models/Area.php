<?php

namespace Zifan\AddressParser\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Zifan\AddressParser\DataProviderInterface;

/**
 * Zifan\AddressParser\Models\Area
 *
 * @property int $id
 * @property string $name 名称
 * @property int $parent_id 父ID
 * @property int $level 深度，从1开始
 * @property-read \Illuminate\Database\Eloquent\Collection|Area[] $children
 * @property-read int|null $children_count
 * @property-read Area $parent
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereParentId($value)
 * @mixin \Eloquent
 */
class Area extends Model implements DataProviderInterface
{
    public $timestamps = false;

    /**
     * @internal 解决依赖：模拟引入 Trait 类，避免直接 use \Encore\Admin\Traits\ModelTree，因为引用外部类须先添加 composer 依赖
     * @see \Encore\Admin\Traits\ModelTree
     */
    protected function initializeTraits()
    {
        parent::initializeTraits();

        $this->initializeModelTree();
    }

    public function initializeModelTree()
    {
        // Set table name
        if ($table = config('addressparser.dateProvicder.table')) {
            $this->setTable($table);
        }

        //$this->titleColumn = 'name';
        //$this->orderColumn = 'id';
    }

    /**
     * Format data to tree like array.
     *
     * @return array
     * @see \Encore\Admin\Traits\ModelTree::toTree() 参考实现
     */
    public function toTree()
    {
        $nodes = $this->allNodes();

        return $this->buildNestedArray($nodes);
    }

    /**
     * Get all elements.
     *
     * @return mixed
     */
    public function allNodes()
    {
        $orderColumn = DB::getQueryGrammar()->wrap('id');
        $byOrder = $orderColumn.' = 0,'.$orderColumn;

        $self = new static();

        //if ($this->queryCallback instanceof \Closure) {
        //    $self = call_user_func($this->queryCallback, $self);
        //}

        return $self->orderByRaw($byOrder)->get()->toArray();
    }

    /**
     * Build Nested array.
     *
     * @param array $nodes
     * @param int   $parentId
     *
     * @return array
     */
    protected function buildNestedArray(array $nodes = [], $parentId = 0)
    {
        $branch = [];

        foreach ($nodes as $key => $node) {
            if ($node['parent_id'] == $parentId) {
                unset($nodes[$key]);

                $children = $this->buildNestedArray($nodes, $node[$this->getKeyName()]);

                if ($children) {
                    $node['children'] = $children;
                }

                $branch[] = $node;
            }
        }

        return $branch;
    }
}