<?php

namespace App\Relations;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BelongsToThrough extends Relation
{

    /** @var Illuminate\Database\Eloquent\Builder */
    protected $query;

    /** @var Illuminate\Database\Eloquent\Model */
    protected $related;

    /** @var Illuminate\Database\Eloquent\Model */
    protected $parent;

    /** @var Illuminate\Database\Eloquent\Model */
    protected $through;

    public function __construct(
        Model $parent,
        Model $farModel,
        Model $closeModel,
        $localKey=null,
        $closeKey=null,
        $farKey=null,
        $closeLocalKey=null,
        $localPrimaryKey=null,
    )
    {
        $this->parent = $parent;
        $this->related = $farModel;
        $this->through = $closeModel;
        $this->query = $this->related->newQuery();
        $this->table = $this->parent->getTable();
        $this->farTable = $this->related->getTable();
        $this->closeTable = $this->through->getTable();
        $this->localKey = $localKey ?? Str::snake($this->closeTable . ' ' . 'id');
        $this->closeKey = $closeKey ?? Str::snake($this->farTable . ' ' . 'id');
        $this->farKey = $farKey ?? 'id';
        $this->closeLocalKey = $closeLocalKey ?? 'id';
        $this->localPrimaryKey = $localPrimaryKey ?? 'id';

        parent::__construct($this->query, $this->parent);
    }

    /**
     * Set the base constraints on the relation query.
     *
     * @return void
     */
    public function addConstraints()
    {
        $this->query
            ->select("{$this->farTable}.*")
            ->from("{$this->table} as local")
            ->join("{$this->closeTable} as close", "local.{$this->localKey}", '=', "close.{$this->closeLocalKey}")
            ->join("{$this->farTable}", "{$this->farTable}.{$this->farKey}", '=', "close.{$this->closeKey}")
            ;

    }

    /**
     * Set the constraints for an eager load of the relation.
     *
     * @param array $models
     *
     * @return void
     */
    public function addEagerConstraints(array $models)
    {
        $this->query->whereIn("local.{$this->localPrimaryKey}",
            collect($models)->pluck($this->localPrimaryKey));
    }

     /**
     * Initialize the relation on a set of models.
     *
     * @param array $models
     * @param string $relation
     *
     */
    public function initRelation(array $models, $relation)
    {
        // dd('init');
        foreach ($models as $model) {
            $model->setRelation(
                $relation,
                $this->related->newCollection()
            );
        }

        return $models;
    }

    /**
     * Get the results of the relationship.
     *
     * @return mixed
     */
    public function getResults()
    {
        return $this->query
            // ->where("local.{$this->localKey}", $this->parent->{$this->localParentId})
            ->get();
    }

    /**
     * Match the eagerly loaded results to their parents.
     *
     * @param array $models
     * @param \Illuminate\Database\Eloquent\Collection $results
     * @param string $relation
     *
     */
    public function match(array $models, Collection $results, $relation)
    {
        // dd('match');
        if ($results->isEmpty()) {
            return $models;
        }

        foreach ($models as $model) {
            $model->setRelation(
                $relation,
                $results[0]
            );
        }

        return $models;
    }
}
