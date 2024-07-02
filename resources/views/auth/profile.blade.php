<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <div>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}" required>
        </div>
        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" value="{{ $user->last_name }}" required>
        </div>
        <div>
            <label for="status">Status:</label>
            <input type="text" name="status" id="status" value="{{ $user->status }}" required>
        </div>
        <div>
            <label for="plan_id">Plan ID:</label>
            <input type="number" name="plan_id" id="plan_id" value="{{ $user->plan_id }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
</body>
</html>
