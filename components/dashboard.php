<?php

if (!isset($_SESSION['user'])) {
    echo "<script type='text/javascript'>window.location.href = 'signin';</script>";
    exit();
}
?>
<html>

<head>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
        rel="stylesheet"
        as="style"
        onload="this.rel='stylesheet'"
        href="https://fonts.googleapis.com/css2?display=swap&amp;family=Lexend%3Awght%40400%3B500%3B700%3B900&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900" />

    <title>Galileo Design</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#1e5dac',
                        'primary-dark': '#154785',
                        'secondary': '#b7c5da',
                        'accent': '#eae2e4',
                        'success': '#10B981',
                        'warning': '#F1C40F',
                        'error': '#E74C3C',
                        'background': '#f8fafb',
                        'surface': '#FFFFFF',
                        'text': '#333333',
                        'text-light': '#7F8C8D',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .scrollbar-thin::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 2px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body>
    <!-- <div class="relative max-w-7xl mx-auto flex size-full h-50vh flex-col bg-background group/design-root overflow-x-hidden" style='font-family: Lexend, "Noto Sans", sans-serif;'> -->
    <div class="layout-container grid grid-cols-11 gap-4 max-h-[50vh] scrollbar-thin">
        <div class="col-span-1"></div>
        <div class="col-span-1"></div>
        <!-- <div class="layout-content-container relative col-span-2  z-30 flex flex-col h-96"> -->
        <div class="fixed w-52 top-20 left-36 z-30 h-[calc(100vh-40px)]">
            <?php include 'instructor/dashboard/sidebar.php'; ?>
        </div>
        <!-- <div class="col-span-1"></div> -->

        <div class="layout-content-container ml-20 col-span-8 flex flex-col max-h-[100vh] h-70vh">
            <?php
            $tab = isset($_GET['tab']) ? $_GET['tab'] : '';

            switch ($tab) {
                case 'profile':
                    require 'components/profile.php';
                    break;
                case 'courses':
                    require 'instructor/dashboard/course.php';
                    break;
                case 'quiz':
                    require 'instructor/dashboard/quiz.php';
                    break;
                case 'enrollments':
                    require 'instructor/dashboard/enroll.php';
                    break;
                case 'students':
                    require 'instructor/dashboard/students.php';
                    break;
                default:
                    require 'instructor/dashboard/stats.php';
                    break;
            }
            ?>
        </div>
        <div class="col-span-1"></div>

    </div>
    <!-- </div> -->
</body>

</html>