<?php

namespace App\Controllers;

use App\Models\StudentModel;
use CodeIgniter\Controller;

class Student extends Controller
{
    protected StudentModel $model;

    public function __construct()
    {
        $this->model = new StudentModel();
    }

    // ----------------------------------------------------------------
    // READ — List all students (with search & pagination)
    // ----------------------------------------------------------------
    public function index(): string
    {
        $perPage = 5;
        $keyword = $this->request->getGet('search') ?? '';

        $query = $this->model;

        if ($keyword !== '') {
            $query = $query->search($keyword);
        }

        $data = [
            'title'    => 'Student List',
            'students' => $query->paginate($perPage, 'students'),
            'pager'    => $this->model->pager,
            'keyword'  => $keyword,
        ];

        return view('student/list', $data);
    }

    // ----------------------------------------------------------------
    // CREATE — Show the add form
    // ----------------------------------------------------------------
    public function create(): string
    {
        return view('student/form', [
            'title'   => 'Add Student',
            'student' => null,
        ]);
    }

    // ----------------------------------------------------------------
    // STORE — Insert a new student
    // ----------------------------------------------------------------
    public function store()
    {
        $rules = [
            'name'   => 'required|min_length[2]|max_length[100]',
            'email'  => 'required|valid_email|max_length[100]',
            'course' => 'required|max_length[50]',
        ];

        if (! $this->validate($rules)) {
            return view('student/form', [
                'title'      => 'Add Student',
                'student'    => null,
                'validation' => $this->validator,
            ]);
        }

        $this->model->insert([
            'name'   => $this->request->getPost('name'),
            'email'  => $this->request->getPost('email'),
            'course' => $this->request->getPost('course'),
        ]);

        return redirect()->to('/student')->with('success', 'Student added successfully!');
    }

    // ----------------------------------------------------------------
    // EDIT — Show the edit form pre-filled
    // ----------------------------------------------------------------
    public function edit(int $id): string
    {
        $student = $this->model->find($id);

        if (! $student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Student with ID $id not found."
            );
        }

        return view('student/form', [
            'title'   => 'Edit Student',
            'student' => $student,
        ]);
    }

    // ----------------------------------------------------------------
    // UPDATE — Save changes to an existing student
    // ----------------------------------------------------------------
    public function update(int $id)
    {
        $student = $this->model->find($id);

        if (! $student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Student with ID $id not found."
            );
        }

        $rules = [
            'name'   => 'required|min_length[2]|max_length[100]',
            'email'  => 'required|valid_email|max_length[100]',
            'course' => 'required|max_length[50]',
        ];

        if (! $this->validate($rules)) {
            return view('student/form', [
                'title'      => 'Edit Student',
                'student'    => $student,
                'validation' => $this->validator,
            ]);
        }

        $this->model->update($id, [
            'name'   => $this->request->getPost('name'),
            'email'  => $this->request->getPost('email'),
            'course' => $this->request->getPost('course'),
        ]);

        return redirect()->to('/student')->with('success', 'Student updated successfully!');
    }

    // ----------------------------------------------------------------
    // DELETE — Soft-delete a student
    // ----------------------------------------------------------------
    public function delete(int $id)
    {
        $student = $this->model->find($id);

        if (! $student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Student with ID $id not found."
            );
        }

        // useSoftDeletes = true, so this sets deleted_at instead of removing the row
        $this->model->delete($id);

        return redirect()->to('/student')->with('success', 'Student deleted successfully!');
    }
}
