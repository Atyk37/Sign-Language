<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['user'])) {
        $username = $_SESSION['user']['username'];
        $role = $_SESSION['user']['role'];
        $id = $_SESSION['user']['user_id'];
    } else {
        $username = null; // If not logged in
    }
}

// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
//     if (isset($_SESSION['user'])) {
//         $username = $_SESSION['user']['username']; 
//         $role = $_SESSION['user']['role']; 
//         $id = $_SESSION['user']['user_id']; 
//     } else {
//         $username = null; // If not logged in
//     }
// }
// echo $username;

// session_unset();  // Unset all session variables
// session_destroy(); // Destroy the session
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

?>
<script>
    // Get username from PHP session and store in localStorage
    let username = <?php echo json_encode($username); ?>;
    let role = <?php echo json_encode($role); ?>;
    let id = <?php echo json_encode($id); ?>;
    // console.log(username);
    if (username) {
        localStorage.setItem("username", username);
        localStorage.setItem("role", role);
        localStorage.setItem("id", id);
    }

    // localStorage.removeItem("username"); // Clears username from localStorage
</script>
<?php
$navItems = ["Learning", "Instructor", "Enterprise", "Scholarship"];
$features = [
    [
        "title" => "CLASS PROGRAM OPTIONS",
        "description" => "Some theorists focus on a single to overarching purpose of education and see.",
        "bg" => "bg-primary"
    ],
    [
        "title" => "ACCESS ANYWHERE",
        "description" => "Some theorists focus on a single to overarching purpose of education and see.",
        "bg" => "bg-[#FBF7F4]"
    ],
    [
        "title" => "FLEXIBLE TIME",
        "description" => "Some theorists focus on a single to overarching purpose of education and see.",
        "bg" => "bg-[#FBF7F4]"
    ]
];

$services = [
    "Research Creation",
    "UX/UI Analysis",
    "Web Development",
    "Market Analysis",
    "Product Design"
];

$courses = [
    [
        "title" => "The Web Design Course",
        "price" => "$80.00",
        "duration" => "2h 40m"
    ],
    [
        "title" => "UI/UX Design Course",
        "price" => "$120.00",
        "duration" => "1h 30m"
    ],
    [
        "title" => "Product Design",
        "price" => "$90.00",
        "duration" => "2h 15m"
    ]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUTOCK - Online Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="utils/toaster.js"></script>

    <script>
        // Function to check URL query parameters and open/close chatbox accordingly
        function checkChatState() {
            const urlParams = new URLSearchParams(window.location.search);
            const chatState = urlParams.get('chat');
            let chatBox = document.getElementById("chat-box");

            if (chatBox) {
                chatBox.classList.toggle("hidden", chatState !== 'open');
            }
        }


        // Run the checkChatState function when the page loads
        window.onload = checkChatState;

        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#4A90E2',
                        'primary-dark': '#2A69A4',
                        'secondary': '#7ED321',
                        'accent': '#F5A623',
                        'success': '#10B981',
                        'warning': '#F1C40F',
                        'error': '#E74C3C',
                        'background': '#f8fafb',
                        'surface': '#FFFFFF',
                        'text': '#333333',
                        'text-light': '#7F8C8D',
                    }
                }
            }
        }

        function toggleChat() {
            let chatBox = document.getElementById('chat-box');
            chatBox.classList.toggle('hidden');
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

<body class="bg-background scrollbar-thin">
    <!-- Header -->
    <header class="bg-primary sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="text-white font-bold text-xl">EDUTOCK</div>
                <?php include 'nav.php'; ?>
                <div class="flex items-center space-x-4">
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['logged_in']): ?>
                        <a href="<?php echo ($_SESSION['user']['role'] === 'teacher') ? '/dashboard?tab=statistics' : '/profile'; ?>" class="text-white font-bold hover:underline">
                            Hello, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>
                        </a>
                        <img id="profile-avatar" class="size-8 cursor-pointer" src="/assets/userAvatar.svg" alt="" onclick="window.location.href='<?php echo ($_SESSION['user']['role'] === 'teacher') ? '/dashboard?tab=statistics' : '/profile'; ?>';">
                    <?php else: ?>
                        <a href="/signup" class="bg-white px-6 py-2 rounded-md text-primary font-medium">Join Now</a>
                        <a href="/signin" class="text-white">Log in</a>
                    <?php endif; ?>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        let username = localStorage.getItem("username");
                        let role = localStorage.getItem("role");
                        if (username && role) {
                            let profileLink = document.querySelector('.flex.items-center.space-x-4 a');
                            let avatarImg = document.getElementById('profile-avatar');
                            if (profileLink && avatarImg) {
                                profileLink.href = (role === 'teacher') ? '/dashboard' : '/profile';
                                avatarImg.onclick = function() {
                                    window.location.href = (role === 'teacher') ? '/dashboard' : '/profile';
                                };
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </header>

    <?php
    $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = trim($urlPath, '/');

    switch ($uri) {
        case 'q':
            require 'components/instructor/dashboard/quizForm.php';
            break;
        case 'signingup':
            require 'handlers/signup.php';
            break;
        case 'signingin':
            require 'handlers/signin.php';
            break;
        case 'signin':
            require 'components/signin.php';
            break;
        case 'signup':
            require 'components/signup.php';
            break;
        case 'instructor-signup':
            require 'components/instructorSignUp.php';
            break;
        case 'dashboard':
            require 'components/dashboard.php';
            break;
        case 'category':
            require 'components/categories.php';
            break;
        case 'profile':
            require 'components/profile.php';
            break;
        case 'creator':
            require 'components/creator-profile.php';
            break;
        case 'ai':
            require 'components/ai.php';
            break;
        case 'courseDetails':
            require 'components/courseDetails.php';
            break;
        case '':
            require 'components/home.php';
            break;
        default:
            require 'components/notfound.php';
            break;
    }
    ?>

    <?php include 'components/ai.php' ?>

    <?php
    $hiddenPages = ['dashboard', 'profile', 'settings', 'signin', 'signup', 'category']; // Pages where the footer should be hidden

    // Extract the last segment of the URI (ignoring query parameters)
    $currentPage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    if (!in_array($uri, $hiddenPages)) {
        echo '
        <!-- Modern footer -->
        <div class="mt-16 max-w-6xl mx-auto pt-8 border-t border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-sm">
                    © ' . date('Y') . ' Sign Language Learning Platform
                </p>
    
                <div class="flex items-center space-x-6">
                    <a href="#" class="text-gray-500 hover:text-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>
                </div>
            </div>
        </div>';
    }

    ?>

    <script>
        function openAvatarModal() {
            document.getElementById('avatar-modal').classList.remove('hidden');
        }

        // Close Modal
        function closeAvatarModal() {
            document.getElementById('avatar-modal').classList.add('hidden');
        }

        // Select Avatar
        function selectAvatar(avatarPath) {
            localStorage.setItem('selectedAvatar', avatarPath);
            document.querySelectorAll('#profile-avatar').forEach(function(avatar) {
                avatar.src = avatarPath;
            });
            closeAvatarModal();
        }

        // Load Avatar from Local Storage
        document.addEventListener('DOMContentLoaded', function() {
            const storedAvatar = localStorage.getItem('selectedAvatar');
            if (storedAvatar) {
                document.querySelectorAll('#profile-avatar').forEach(function(avatar) {
                    avatar.src = storedAvatar;
                });
            }
        });
    </script>


</body>

</html>