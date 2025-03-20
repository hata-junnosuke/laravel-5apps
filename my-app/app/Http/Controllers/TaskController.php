<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::getActiveTasks();
        return view('tasks.index', compact('tasks'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            // 'due_date' => 'required|date|',
        ]);
        Task::create([
            'task_name' => $request->task_name,
            'due_date' => $request->due_date,
        ]);
        return redirect()->route('tasks.index')->with('success', 'タスクが作成されました');
    }

    public function maskAsDeleted($id)
    {
        Task::maskAsDeleted($id);
        return redirect()->route('tasks.index')->with('success', 'タスクが削除されました');
    }

    public function trash()
    {
        $tasks = Task::getTrashTasks();
        return view('tasks.trash', compact('tasks'));
    }

    public function recover($id)
    {
        Task::recoverTask($id);
        return redirect()->route('tasks.index')->with('success', 'タスクが復元されました');
    }

    public function deleteTrash()
    {
        Task::deleteTrashPermanently();
        return redirect()->route('tasks.index')->with('success', 'ゴミ箱が空になりました');
    }
    
}
