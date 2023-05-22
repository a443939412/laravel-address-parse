<?php

namespace Zifan\LaravelAddressParser\Models;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Zifan\AddressParser\DataProviderInterface;

/**
 * Zifan\LaravelAddressParser\Models\Area
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
     * @var Closure
     */
    protected $queryAllNodesCallback;

    /**
     * @internal 解决依赖：模拟引入 Trait 类
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
    public function toTree(): array
    {
        $nodes = $this->allNodes();

        return $this->buildNestedArray($nodes);
    }

    /**
     * Get all elements.
     *
     * @return array
     * @link https://blog.csdn.net/BHSZZY/article/details/120154941 #order by = 用法说明
     */
    public function allNodes()
    {
        $query = static::query();

        /*$orderColumn = $query->grammar->wrap('parent_id');
        $byOrder = $orderColumn.' = 0,'.$orderColumn;*/

        if ($this->queryAllNodesCallback instanceof Closure) {
            call_user_func($this->queryAllNodesCallback, $query);
        }

        return $query->get()->toArray(); // ->orderByRaw($byOrder)
    }

    /**
     * Build Nested array.
     *
     * @param array $nodes
     * @param int   $parentId
     *
     * @return array
     */
    protected function buildNestedArray(array $nodes = [], $parentId = 0): array
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

    /**
     * Set all nodes query callback to model.
     *
     * @param Closure $callback
     *
     * @return $this
     */
    public function withAllNodesQuery(Closure $callback)
    {
        $this->queryAllNodesCallback = $callback;

        return $this;
    }
}
