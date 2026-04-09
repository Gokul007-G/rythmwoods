<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* New styles for the sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: black;
            padding-top: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
        }


        .sidebar-icon {
            color: white;
            font-size: 24px;
            cursor: pointer;
            margin-bottom: 20px;
            transition: transform 0.3s;
            height: 4vh;
            width: 4vh;
            margin-right: 10px;
            /* Add transition for smooth effect */
        }


        .sidebar-item:hover .sidebar-icon {
            transform: scale(1.2);
            /* Zoom effect on hover */
        }

        .sidebar-item:hover {
            background-color: pink;
            /* Pink background color on hover */
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            /* vertical alignment */
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .sidebar-text {
            color: white;
            font-size: 18px;
            /* Adjust font size as needed */
            margin-left: 10px;
            /* Add margin to separate icon and text */
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-item" onclick="Profile_pic()">
            <img src="/rythm/assets/music.png" alt="music" class="sidebar-icon">
            <span id="musicText" class="sidebar-text">Profile_pic</span>
        </div>
        <div class="sidebar-item" onclick="Profile_details()">
            <img src="/rythm/assets/event.png" alt="addevent" class="sidebar-icon">
            <span id="addeventText" class="sidebar-text">Profile_details</span>
        </div>
    </div>
</body>
</html>