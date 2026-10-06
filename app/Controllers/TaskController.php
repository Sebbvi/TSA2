<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;

class TaskController extends BaseController
{
    public function index()
    {
        $taskModel = new TaskModel();
        
        $today = date('Y-m-d'); 
        
        $data['tasks'] = $taskModel->where('task_date', $today)->findAll();
        $data['title'] = "Today's Tasks";

        return view('welcome_page', $data);
    }

    public function allTasks()
    {
        $taskModel = new TaskModel();
        
        $data['tasks'] = $taskModel->orderBy('task_date', 'ASC')->findAll();
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
}
