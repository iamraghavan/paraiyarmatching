<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .profile-image {
            width: 100%;
            max-width: 200px;
            height: auto;
        }
        .profile-info {
            margin-top: 20px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset($user->profile_image) }}" alt="Profile Image" class="profile-image">
            </div>
            <div class="col-md-8 profile-info">
                <h2>{{ $user->name }}</h2>
                <p><strong>Date of Birth:</strong> {{ $profile->dob }}</p>
                <!-- Add other profile information here -->
                <p><strong>Age:</strong> {{ $profile->age }}</p>
                <p><strong>Height:</strong> {{ $profile->height }}</p>
                <p><strong>Religion:</strong> {{ $profile->religion }}</p>
                <!-- Add more profile fields as needed -->
            </div>
        </div>
    </div>
    <footer class="footer">
        <p>Verified by PARAIYAR MATCHING</p>
        <p>Note: This is a computer-generated document</p>
    </footer>
</body>
</html>
