<?php
namespace App\Contracts;
interface BaseContract {
    /**
     * Create a new resource.
     * @param array $attributes
     * @return mixed
    */
    public function store(array $attributes);

    /**
     * Update a resource.
     * @param array $attributes
     * @param int $id
     * @return mixed
    */
    public function update(array $attributes, int $id);

    /**
     * Return all resources.
     * @param array $filter
     * @return mixed
    */
    public function index(array $filter = []);

    /**
    * Return a resource by id.
     * @param int $id
     * @return mixed
    */
    public function show(int $id);

    /**
     * Return a resource by id.
     * @param int $id
     * @return mixed
    */
    public function destroy(int $id);
}
