<?php

namespace App\Controllers\Api;

use App\Models\StudentModel;
use CodeIgniter\RESTful\ResourceController;

class StudentApi extends ResourceController
{
    protected $modelName = 'App\Models\StudentModel';
    protected $format    = 'json';

    /**
     * GET /api/students
     * Returns all student records as JSON.
     */
    public function index()
    {
        $model    = new StudentModel();
        $students = $model->findAll();

        return $this->respond($students, 200);
    }

    /**
     * GET /api/students/(:num)
     * Returns a single student record.
     */
    public function show($id = null)
    {
        $model   = new StudentModel();
        $student = $model->find($id);

        if (! $student) {
            return $this->failNotFound("No student found with ID $id");
        }

        return $this->respond($student, 200);
    }
}
