<!DOCTYPE html>
<html>

<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .containerProfile {
            max-width: 1400px;
            margin: 25px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 50px;
            margin-top: 50px;
            font-size: 2.5em;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .team-grid {
            display: flex;
            flex-direction: column;
            gap: 30px;
            padding: 20px;
        }

        /* Horizontal layout for screens larger than 1024px */
        @media (min-width: 1024px) {
            .team-grid {
                flex-direction: row;
                justify-content: center;
                flex-wrap: nowrap;
            }

            .team-member {
                flex: 1;
                max-width: 300px;
            }
        }

        /* Vertical layout for screens smaller than 1024px */
        @media (max-width: 1023px) {
            .team-grid {
                flex-direction: column;
                align-items: center;
            }

            .team-member {
                width: 100%;
                max-width: 400px;
            }
        }

        .team-member {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .profile-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-bottom: 4px solid rgb(255, 139, 61);
            transition: transform 0.3s ease;
        }

        .team-member:hover .profile-img {
            transform: scale(1.05);
        }

        .member-info {
            padding: 20px;
            text-align: center;
        }

        .member-name {
            color: #2c3e50;
            font-size: 1.4em;
            margin-bottom: 5px;
            position: relative;
            display: inline-block;
        }

        .member-name::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 50%;
            background: rgb(255, 139, 61);
            transition: all 0.3s ease;
        }

        .team-member:hover .member-name::after {
            width: 100%;
            left: 0;
        }

        .member-id {
            color: #7f8c8d;
            font-size: 0.9em;
            margin-bottom: 10px;
        }

        .member-position {
            color: orange;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.9em;
            letter-spacing: 1px;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .team-member:hover .member-position {
            opacity: 1;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .team-member {
            animation: fadeIn 0.5s ease forwards;
            opacity: 0;
        }

        .team-member:nth-child(1) {
            animation-delay: 0.1s;
        }

        .team-member:nth-child(2) {
            animation-delay: 0.2s;
        }

        .team-member:nth-child(3) {
            animation-delay: 0.3s;
        }

        .team-member:nth-child(4) {
            animation-delay: 0.4s;
        }
    </style>
</head>
@extends('layouts.page')
@section('content')

    <body>
        <div class="containerProfile">
            <h1>Our Team</h1>
            <div class="team-grid">
                <div class="team-member">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="John Doe" class="profile-img">
                    <div class="member-info">
                        <h2 class="member-name">John Doe</h2>
                        <p class="member-id">ID: JD001</p>
                        <p class="member-position">Chief Executive Officer</p>
                    </div>
                </div>

                <div class="team-member">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Jane Smith" class="profile-img">
                    <div class="member-info">
                        <h2 class="member-name">Jane Smith</h2>
                        <p class="member-id">ID: JS002</p>
                        <p class="member-position">Creative Director</p>
                    </div>
                </div>

                <div class="team-member">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Mike Johnson" class="profile-img">
                    <div class="member-info">
                        <h2 class="member-name">Mike Johnson</h2>
                        <p class="member-id">ID: MJ003</p>
                        <p class="member-position">Technical Lead</p>
                    </div>
                </div>

                <div class="team-member">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Sarah Williams" class="profile-img">
                    <div class="member-info">
                        <h2 class="member-name">Sarah Williams</h2>
                        <p class="member-id">ID: SW004</p>
                        <p class="member-position">Marketing Manager</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection

</html>
