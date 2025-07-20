<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maxit - Mobile Banking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        /* Custom styles pour les icônes */
        .icon-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2px;
        }
        .icon-dot {
            width: 4px;
            height: 4px;
            background-color: #fbbf24;
            border-radius: 50%;
        }
        .payment-icon {
            width: 32px;
            height: 32px;
            border: 2px solid #fb923c;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .payment-icon::before {
            content: '';
            width: 16px;
            height: 16px;
            background-color: #fb923c;
            border-radius: 50%;
        }
        .payment-icon::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            background-color: #fb923c;
            border-radius: 50%;
        }
        
        /* Sidebar styles */
        .sidebar {
            transform: translateX(0);
            transition: none;
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            .sidebar.open {
                transform: translateX(0);
            }
        }
        
        /* Orange gradient */
        .orange-gradient {
            background: linear-gradient(135deg, #ff6b35 0%, #ff8e3c 50%, #ffa726 100%);
        }
        
        /* Glassmorphism effect */
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Animations */
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-slide-in {
            animation: slideIn 0.6s ease-out;
        }
        
        .animate-delay-1 { animation-delay: 0.1s; }
        .animate-delay-2 { animation-delay: 0.2s; }
        .animate-delay-3 { animation-delay: 0.3s; }
        .animate-delay-4 { animation-delay: 0.4s; }
    </style>
</head>
<body class="bg-gray-50 overflow-hidden">
    <!-- Sidebar Overlay (mobile only) -->
    
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>
    
    <!-- Sidebar -->
     <?php
     require_once __DIR__ .'/partial/sidebar.html.php'
     ?>
    
    <!-- Main Content -->
    <?php
        require_once __DIR__ .'/partial/navbar.html.php'

   ?>
   <div>
    <?php
        echo $content;
        // require_once '../template/accueil/accueil.html.php'
    ?>

   </div>
   



</body>
</html>