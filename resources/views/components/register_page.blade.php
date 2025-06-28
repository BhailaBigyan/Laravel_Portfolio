<!-- resources/views/components/register.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
  <form action="{{ route('register.post') }}" method="POST" class="bg-white p-8 rounded shadow-md w-full max-w-sm">
    @csrf
    <h2 class="text-2xl font-semibold mb-6">Create Account</h2>

    <div class="mb-4">
      <label for="name" class="block text-gray-700">Name</label>
      <input type="text" name="name" id="name" class="w-full border border-gray-300 p-2 rounded" required>
    </div>
    <div class="mb-4">
        <!-- alert -->
         <i class="text-red-500">Please enter the username of your github account</i>
        <label for="username" class="block text-gray-700">Username</label>
        <input type="text" name="username" id="username" class="w-full border border-gray-300 p-2 rounded" required>
    </div>
    <div class="mb-4">
      <label for="email" class="block text-gray-700">Email</label>
      <input type="email" name="email" id="email" class="w-full border border-gray-300 p-2 rounded" required>
    </div>

    <div class="mb-4">
      <label for="password" class="block text-gray-700">Password</label>
      <input type="password" name="password" id="password" class="w-full border border-gray-300 p-2 rounded" required>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Register</button>

    <p class="mt-4 text-sm text-center">
      Already have an account?
      <a href="{{ route('login') }}" class="text-blue-600 underline">Login</a>
    </p>
  </form>
</body>
</html>
