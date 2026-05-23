<!DOCTYPE html>
<html>
<head>
    <title>Redirecting...</title>
    <meta http-equiv="refresh" content="0;url={{ route('login') }}">
</head>
<body>
    <p>Redirecting to login...</p>
    <script>window.location.href = "{{ route('login') }}";</script>
</body>
</html>
