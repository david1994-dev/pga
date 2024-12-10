<?php
namespace App\Services;

use App\Contracts\BaseContract;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InternalServerErrorException;
use App\Exceptions\ResourceNotFoundException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BaseService implements BaseContract {
    /**
     * @var array
     * List of searchable columns
    */
    protected $searchable = [];

    /**
     * @return Model
    */
    public function getBlankModel(): Model {
        return new Model();
    }

    /**
     * @return string
    */
    public function getModelClassName(): string {
        return get_class($this->getBlankModel());
    }

    /**
     * @param array $attributes
     * @return mixed
    */
    public function store(array $attributes) {
        return $this->getModelClassName()::create($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
    */
    public function update(array $attributes, int $id) {
        $model = $this->getModelClassName()::find($id);
        return $model->update($attributes);
    }

    /**
     * @return mixed
     * @param array $filter
    */
    public function index(array $filter = []) {
        $query = $this->getModelClassName()::query();
        if (isset($filter['q'])) {
            $query->where(function ($query) use ($filter) {
                foreach ($this->searchable as $column) {
                    $query->orWhere($column, 'LIKE', '%' . $filter['q'] . '%');
                }
            });
        }

        return $query->paginate($filter['limit'] ?? 10);
    }

    /**
     * @param int $id
     * @return mixed
    */
    public function show(int $id) {
        return $this->getModelClassName()::findOrFail($id);
    }

    /**
     * @param int $id
     * @return mixed
    */
    public function destroy(int $id) {
        $model = $this->getModelClassName()::findOrFail($id);
        $model->delete();

        return $model;
    }
}
