<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;

class TaskController extends BaseController
{
    // PUBLIC PAGES (Hide archived tasks where is_archived = 1)
    public function index()
    {
        $taskModel = new TaskModel();
        $today = date('Y-m-d');

        $data['tasks'] = $taskModel->where('task_date', $today)
                                   ->where('is_archived', 0)
                                   ->findAll();
        $data['title'] = "Today's Tasks";

        return view('welcome_page', $data);
    }

    public function allTasks()
    {
        $taskModel = new TaskModel();

        $data['tasks'] = $taskModel->where('is_archived', 0)
                                   ->orderBy('task_date', 'ASC')
                                   ->findAll();
        $data['title'] = "All Registered Tasks";

        return view('tasks_page', $data);
    }

    public function profile()
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->first();
        $data['title'] = "User Profile";

        return view('profile_page', $data);
    }

    public function about()
    {
        $data['title'] = "About the Developer";
        return view('about_page', $data);
    }

    // PROTECTED CRUD ACTIONS
    public function newTask()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $data['title'] = "Add New Task";
        return view('new_task_page', $data);
    }

    public function createTask()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $title = trim($this->request->getPost('title'));
        $taskDate = $this->request->getPost('task_date');
        $status = $this->request->getPost('status') ?? 'pending';

        if (empty($title) || empty($taskDate)) {
            return redirect()->back()->withInput()->with('error', 'Title and Task Date are required.');
        }

        $taskModel = new TaskModel();
        $taskModel->insert([
            'title'       => $title,
            'status'      => $status,
            'task_date'   => $taskDate,
            'is_archived' => 0,
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/tasks');
    }

    public function editTask($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if (!$task || $task['is_archived'] == 1) {
            return redirect()->to('/tasks');
        }

        $data['task'] = $task;
        $data['title'] = "Edit Task";
        return view('edit_task_page', $data);
    }

    public function updateTask($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $title = trim($this->request->getPost('title'));
        $taskDate = $this->request->getPost('task_date');
        $status = $this->request->getPost('status');

        if (empty($title) || empty($taskDate)) {
            return redirect()->back()->withInput()->with('error', 'Title and Task Date are required.');
        }

        $taskModel = new TaskModel();
        $taskModel->update($id, [
            'title'     => $title,
            'status'    => $status,
            'task_date' => $taskDate,
        ]);

        return redirect()->to('/tasks');
    }

    public function deleteTask($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $taskModel = new TaskModel();
        // Soft delete: set is_archived = 1 instead of deleting the row
        $taskModel->update($id, ['is_archived' => 1]);

        return redirect()->to('/tasks');
    }
}
