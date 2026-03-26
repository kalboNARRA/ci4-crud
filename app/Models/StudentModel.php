<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'students';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = ['name', 'email', 'course'];

    // Soft Deletes
    protected $useSoftDeletes = true;
    protected $deletedField   = 'deleted_at';

    // Timestamps
    protected $useTimestamps = false;

    // Validation
    protected $validationRules = [
        'name'   => 'required|min_length[2]|max_length[100]',
        'email'  => 'required|valid_email|max_length[100]',
        'course' => 'required|max_length[50]',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Full name is required.',
            'min_length' => 'Name must be at least 2 characters.',
        ],
        'email' => [
            'required'    => 'Email address is required.',
            'valid_email' => 'Please enter a valid email address.',
        ],
        'course' => [
            'required' => 'Course is required.',
        ],
    ];

    protected $skipValidation = false;

    /**
     * Search students by name, email, or course.
     *
     * @param string $keyword
     * @return $this
     */
    public function search(string $keyword)
    {
        return $this->groupStart()
                    ->like('name', $keyword)
                    ->orLike('email', $keyword)
                    ->orLike('course', $keyword)
                    ->groupEnd();
    }
}
