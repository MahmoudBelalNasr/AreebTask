<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface{

    public function list($request)
    {
        $user = auth()->user();

        if ($user->isManager()) {
            $users = $user->children();
        } else {
            $users = User::where('id', $user->id);
        }

        if (request()->filled('search')) {
            $searchTerm = request()->search;
            $users = $users->where(function ($query) use ($searchTerm) {
                $query->where('id', 'LIKE', "%$searchTerm%")
                    ->orWhere('email', 'LIKE', "%$searchTerm%")
                    ->orWhere('phone', 'LIKE', "%$searchTerm%")
                    ->orWhere('salary', 'LIKE', "%$searchTerm%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE '%$searchTerm%'");
            });
        }

        if (request()->filled('department')) {
            $users = $users->where('department_id','=' , request()->department);
        }

        return $users->paginate(10);

    }

    public function findById($id){
        return User::findOrFail($id);
    }

    public function create($request)
    {
        $validatedData = $request->validated();
        unset($validatedData['image']);

        if (request()->hasFile('image')) {
            $imagePath = request()->file('image')->store('users', 'public');
            $validatedData['image'] = $imagePath;
        }

        $validatedData['name'] = $validatedData['first_name'] . ' ' . $validatedData['last_name'];
        $validatedData['manager_id'] = auth()->user()->id;

        $user = User::create($validatedData);

        if ($user) {
            return true;
        }

        return false;
    }


    public function update($data, $id)
    {
        $validatedData = $data->validated();
        unset($validatedData['image']);

        if (request()->hasFile('image')) {
            $imagePath = request()->file('image')->store('users', 'public');
            $validatedData['image'] = $imagePath;
        }

        $validatedData['name'] = $validatedData['first_name'] . ' ' . $validatedData['last_name'];
        $validatedData['manager_id'] = auth()->user()->id;

        $user = $this->findById($id);
        $validatedData['password'] = bcrypt($validatedData['password']) ?? $user->password;

        $user->update($validatedData);
    }

    public function delete($id)
    {
        $user = $this->findById($id);
        if ($user->manager_id == auth()->user()->id) {
            return $user->delete();
        }

        abort(403, 'Unauthorized action.');
    }
}
