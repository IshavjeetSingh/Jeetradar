<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Recommendations - RoamRadar</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f6f8ff 0%, #f0f3ff 100%);
            color: #333;
            overflow-x: hidden;
        }

        .nav-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            animation: gradientShift 8s ease infinite;
        }

        .nav-container.scrolled {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .logo-container {
            position: relative;
            overflow: hidden;
            padding: 0.5rem;
        }

        .logo-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: shine 3s infinite;
        }

        .logo-container::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .logo-container:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: bold;
            position: relative;
            transition: all 0.3s ease;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo-container:hover .gradient-text {
            transform: scale(1.05) translateY(-2px);
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: #4f46e5;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-weight: 500;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .nav-link:hover::before {
            transform: scaleX(1);
            transform-origin: left;
        }

        .nav-link:hover {
            color: #6366f1;
            transform: translateY(-2px);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .nav-link.active {
            color: #6366f1;
            background: rgba(99, 102, 241, 0.1);
        }

        .nav-link.active::before {
            transform: scaleX(1);
        }

        .register-button {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .register-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .register-button:hover::before {
            left: 100%;
        }

        .register-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        .register-button i {
            transition: transform 0.3s ease;
        }

        .register-button:hover i {
            transform: rotate(45deg);
        }

        .mobile-menu-button {
            display: none;
            flex-direction: column;
            gap: 6px;
            padding: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .menu-line {
            width: 24px;
            height: 2px;
            background: #4f46e5;
            transition: all 0.3s ease;
            transform-origin: center;
        }

        .mobile-menu-button.active .menu-line:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }

        .mobile-menu-button.active .menu-line:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-button.active .menu-line:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }

        @media (max-width: 768px) {
            .nav-links {
                position: fixed;
                top: 70px;
                left: 0;
                width: 100%;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
                transform: translateY(-100%);
                opacity: 0;
                transition: all 0.3s ease;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }

            .nav-links.active {
                transform: translateY(0);
                opacity: 1;
            }

            .mobile-menu-button {
                display: flex;
            }

            .nav-link {
                width: 100%;
                text-align: center;
            }

            .register-button {
                width: 100%;
                justify-content: center;
            }
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            transition: transform 0.3s ease;
        }

        .logo-container:hover .logo-text {
            transform: scale(1.05);
        }

        .form-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(99, 102, 241, 0.1);
            position: relative;
            overflow: hidden;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-color: rgba(99, 102, 241, 0.3);
        }

        .form-card:hover::before {
            opacity: 1;
        }

        .form-input {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .activity-checkbox {
            display: none;
        }

        .activity-label {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .activity-label::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .activity-checkbox:checked + .activity-label {
            color: white;
            border-color: transparent;
        }

        .activity-checkbox:checked + .activity-label::before {
            opacity: 1;
        }

        .activity-icon {
            margin-right: 8px;
            transition: transform 0.3s ease;
        }

        .activity-checkbox:checked + .activity-label .activity-icon {
            transform: scale(1.2);
        }

        .submit-button {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .submit-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .submit-button:hover::before {
            left: 100%;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .progress-bar {
            height: 4px;
            background: #e2e8f0;
            border-radius: 2px;
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            width: 0%;
            transition: width 0.5s ease;
        }

        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 8px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.875rem;
        }

        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        .tooltip .tooltip-text::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #333 transparent transparent transparent;
        }

        .form-section {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .form-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .budget-slider {
            -webkit-appearance: none;
            width: 100%;
            height: 6px;
            border-radius: 3px;
            background: #e2e8f0;
            outline: none;
            margin: 1rem 0;
        }

        .budget-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: all 0.2s ease;
        }

        .budget-slider::-webkit-slider-thumb:hover {
            transform: scale(1.2);
        }

        .budget-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: #6366f1;
            text-align: center;
            margin-top: 0.5rem;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .logo-container {
            position: relative;
            display: inline-block;
        }

        .logo-container::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .logo-container:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .nav-toggle {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 21px;
            cursor: pointer;
            position: relative;
            z-index: 2;
            padding: 0.5rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .nav-toggle:hover {
            background: rgba(99, 102, 241, 0.1);
        }

        .nav-toggle span {
            display: block;
            height: 3px;
            width: 100%;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            border-radius: 3px;
            transition: all 0.3s ease;
            transform-origin: center;
        }

        .nav-toggle.active span:nth-child(1) {
            transform: translateY(9px) rotate(45deg);
        }

        .nav-toggle.active span:nth-child(2) {
            opacity: 0;
            transform: scale(0);
        }

        .nav-toggle.active span:nth-child(3) {
            transform: translateY(-9px) rotate(-45deg);
        }

        .nav-menu {
            display: flex;
            align-items: center;
        }

        @media (max-width: 768px) {
            .nav-toggle {
                display: flex;
            }

            .nav-menu {
                position: fixed;
                top: 70px;
                left: 0;
                width: 100%;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                padding: 1rem;
                flex-direction: column;
                align-items: flex-start;
                box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
                transform: translateY(-100%);
                opacity: 0;
                transition: all 0.3s ease;
                z-index: 50;
            }

            .nav-menu.active {
                transform: translateY(0);
                opacity: 1;
            }

            .nav-menu a {
                margin: 0.5rem 0;
                width: 100%;
                padding: 0.75rem 0;
                transform: translateX(-20px);
                opacity: 0;
                transition: all 0.3s ease;
            }

            .nav-menu.active a {
                transform: translateX(0);
                opacity: 1;
            }

            .nav-menu a:nth-child(1) { transition-delay: 0.1s; }
            .nav-menu a:nth-child(2) { transition-delay: 0.2s; }
        }

        .page-header {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
            color: white;
            padding: 120px 0 60px;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            opacity: 0.2;
            animation: slowZoom 20s ease-in-out infinite alternate;
        }

        .page-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(30, 27, 75, 0.9) 0%, rgba(49, 46, 129, 0.85) 100%);
            z-index: 1;
        }

        .page-header-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .page-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            animation: fadeInDown 0.8s ease-out;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            border-radius: 2px;
            animation: lineGrow 1s ease-out 0.5s forwards;
            transform-origin: left;
            transform: scaleX(0);
        }

        .page-description {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0;
            animation: fadeInUp 0.8s ease-out 0.3s forwards;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            line-height: 1.6;
        }

        .header-badge {
            display: inline-flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            margin-bottom: 2rem;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .badge-icon {
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            animation: pulse 2s infinite;
        }

        .badge-text {
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .header-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        @keyframes slowZoom {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes lineGrow {
            to {
                transform: scaleX(1);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.7);
            }
            70% {
                transform: scale(1.1);
                box-shadow: 0 0 0 10px rgba(99, 102, 241, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
            }
        }

        .floating-icon {
            position: absolute;
            font-size: 2rem;
            color: rgba(255, 255, 255, 0.2);
            animation: floatIcon 15s ease-in-out infinite;
        }

        .floating-icon:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
        .floating-icon:nth-child(2) { top: 30%; right: 15%; animation-delay: 2s; }
        .floating-icon:nth-child(3) { bottom: 20%; left: 15%; animation-delay: 4s; }
        .floating-icon:nth-child(4) { bottom: 30%; right: 10%; animation-delay: 6s; }
        .floating-icon:nth-child(5) { top: 50%; left: 5%; animation-delay: 8s; }
        .floating-icon:nth-child(6) { top: 60%; right: 5%; animation-delay: 10s; }

        @keyframes floatIcon {
            0% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(10px, -15px) rotate(5deg); }
            50% { transform: translate(5px, 10px) rotate(-5deg); }
            75% { transform: translate(-10px, -5px) rotate(3deg); }
            100% { transform: translate(0, 0) rotate(0deg); }
        }

        .form-container {
            margin-top: -40px;
            position: relative;
            z-index: 10;
        }

        .form-card {
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .form-card-header {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 1.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .form-card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.5;
        }

        .form-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: white;
            position: relative;
            z-index: 1;
        }

        .form-title {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .form-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .form-body {
            padding: 2rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #4f46e5;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 0.5rem;
            color: #6366f1;
        }

        .section-divider {
            height: 2px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            margin: 1.5rem 0;
            border-radius: 1px;
        }

        .activity-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
        }

        .activity-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .activity-item:hover {
            transform: translateY(-5px);
        }

        .activity-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .activity-item:hover::before {
            opacity: 1;
        }

        .activity-checkbox:checked + .activity-label {
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
        }

        .budget-container {
            position: relative;
            padding: 1rem;
            border-radius: 8px;
            background: rgba(99, 102, 241, 0.05);
            margin-bottom: 1.5rem;
        }

        .budget-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 2px solid transparent;
            border-radius: 8px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6) border-box;
            -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: destination-out;
            mask-composite: exclude;
            opacity: 0.5;
        }

        .date-container {
            position: relative;
            padding: 1rem;
            border-radius: 8px;
            background: rgba(99, 102, 241, 0.05);
            margin-bottom: 1.5rem;
        }

        .date-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 2px solid transparent;
            border-radius: 8px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6) border-box;
            -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: destination-out;
            mask-composite: exclude;
            opacity: 0.5;
        }

        .date-input-container {
            position: relative;
            width: 100%;
        }

        .date-input {
            width: 100%;
            padding: 0.75rem 1rem;
            padding-left: 2.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            background-color: white;
            color: #333;
            font-size: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .date-input::-webkit-calendar-picker-indicator {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            padding: 0.5rem;
            color: #6366f1;
        }

        .date-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .date-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6366f1;
            pointer-events: none;
        }

        .date-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #4f46e5;
            font-weight: 500;
        }

        .date-error {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }

        .date-input.error {
            border-color: #ef4444;
        }

        .date-input.error:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .activity-container {
            position: relative;
            padding: 1rem;
            border-radius: 8px;
            background: rgba(99, 102, 241, 0.05);
            margin-bottom: 1.5rem;
        }

        .activity-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 2px solid transparent;
            border-radius: 8px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6) border-box;
            -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: destination-out;
            mask-composite: exclude;
            opacity: 0.5;
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes patternFloat {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 100px 100px;
            }
        }

        @keyframes shine {
            0% {
                left: -100%;
            }
            20% {
                left: 100%;
            }
            100% {
                left: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="nav-container fixed w-full z-50 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="/" class="logo-container">
                <span class="text-2xl gradient-text">RoamRadar</span>
            </a>
            <div class="nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="nav-menu">
                <a href="/recommend" class="nav-link">Recommend</a>
                <a href="/" class="nav-link">Home</a>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <div class="header-particles" id="particles-js"></div>
        <div class="page-header-content">
            <div class="header-badge">
                <div class="badge-icon">
                    <i class="fas fa-compass"></i>
                </div>
                <span class="badge-text">Discover Your Perfect Destination</span>
            </div>
            <h1 class="page-title">Travel Recommendations</h1>
            <p class="page-description">Get personalized travel recommendations based on your preferences, budget, and travel style. Let us help you plan your next adventure.</p>
        </div>
        <i class="fas fa-compass floating-icon"></i>
        <i class="fas fa-map-marked-alt floating-icon"></i>
        <i class="fas fa-plane floating-icon"></i>
        <i class="fas fa-hotel floating-icon"></i>
        <i class="fas fa-umbrella-beach floating-icon"></i>
        <i class="fas fa-mountain floating-icon"></i>
    </div>

    <div class="min-h-screen pb-12 px-6">
        <div class="max-w-3xl mx-auto form-container">
            <div class="form-card floating-element">
                <div class="form-card-header">
                    <div class="form-icon">
                        <i class="fas fa-search-location"></i>
                    </div>
                    <h2 class="form-title">Travel Preferences</h2>
                    <p class="form-subtitle">Fill in your details to get personalized recommendations</p>
                </div>
                
                <!-- Progress Bar -->
                <div class="progress-bar">
                    <div class="progress-fill" id="progressFill"></div>
                </div>
                
                <form action="{{ url('/recommend/results') }}" method="POST" class="form-body" id="recommendForm">
                            @csrf
                            
                    <!-- Budget Section -->
                    <div class="form-section" id="budgetSection">
                        <div class="section-title">
                            <i class="fas fa-wallet"></i> Budget
                        </div>
                        <div class="budget-container">
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <label for="budget" class="block text-sm font-medium text-gray-700">Budget (USD)</label>
                                    <div class="tooltip">
                                        <i class="fas fa-info-circle text-indigo-500 cursor-pointer"></i>
                                        <span class="tooltip-text">Your total budget for the entire trip, including accommodation, activities, and transportation.</span>
                                    </div>
                            </div>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                                    <input type="number" 
                                           class="form-input w-full pl-8" 
                                           id="budget" 
                                           name="budget" 
                                           min="0" 
                                           step="100" 
                                           required
                                           placeholder="Enter your budget">
                                </div>
                                <div class="mt-4">
                                    <input type="range" class="budget-slider" id="budgetSlider" min="0" max="10000" step="100" value="1000">
                                    <div class="budget-value" id="budgetValue">$1,000</div>
                                </div>
                            </div>
                        </div>
                                        </div>

                    <div class="section-divider"></div>

                    <!-- Dates Section -->
                    <div class="form-section" id="datesSection">
                        <div class="section-title">
                            <i class="fas fa-calendar-alt"></i> Travel Dates
                                        </div>
                        <div class="date-container">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <label for="start_date" class="date-label">Travel Start Date</label>
                                        <div class="tooltip">
                                            <i class="fas fa-info-circle text-indigo-500 cursor-pointer"></i>
                                            <span class="tooltip-text">When do you plan to start your journey?</span>
                                        </div>
                                    </div>
                                    <div class="date-input-container">
                                        <i class="fas fa-calendar date-icon"></i>
                                        <input type="date" 
                                               class="date-input" 
                                               id="start_date" 
                                               name="start_date" 
                                               required
                                               min="{{ date('Y-m-d') }}">
                                        <div class="date-error" id="start_date_error"></div>
                                        </div>
                                        </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <label for="end_date" class="date-label">Travel End Date</label>
                                        <div class="tooltip">
                                            <i class="fas fa-info-circle text-indigo-500 cursor-pointer"></i>
                                            <span class="tooltip-text">When do you plan to return home?</span>
                                        </div>
                                    </div>
                                    <div class="date-input-container">
                                        <i class="fas fa-calendar date-icon"></i>
                                        <input type="date" 
                                               class="date-input" 
                                               id="end_date" 
                                               name="end_date" 
                                               required>
                                        <div class="date-error" id="end_date_error"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <!-- Activities Section -->
                    <div class="form-section" id="activitiesSection">
                        <div class="section-title">
                            <i class="fas fa-hiking"></i> Preferred Activities
                        </div>
                        <div class="activity-container">
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Select activities you're interested in</label>
                                    <div class="tooltip">
                                        <i class="fas fa-info-circle text-indigo-500 cursor-pointer"></i>
                                        <span class="tooltip-text">Select the activities you're interested in during your trip.</span>
                                    </div>
                                </div>
                                <div class="activity-grid">
                                    <div class="activity-item">
                                        <input type="checkbox" id="beach" name="activities[]" value="beach" class="activity-checkbox">
                                        <label for="beach" class="activity-label text-center">
                                            <i class="fas fa-umbrella-beach activity-icon"></i> Beach
                                        </label>
                                    </div>

                                    <div class="activity-item">
                                        <input type="checkbox" id="hiking" name="activities[]" value="hiking" class="activity-checkbox">
                                        <label for="hiking" class="activity-label text-center">
                                            <i class="fas fa-mountain activity-icon"></i> Hiking
                                        </label>
                                    </div>

                                    <div class="activity-item">
                                        <input type="checkbox" id="culture" name="activities[]" value="culture" class="activity-checkbox">
                                        <label for="culture" class="activity-label text-center">
                                            <i class="fas fa-landmark activity-icon"></i> Culture
                                        </label>
                                    </div>

                                    <div class="activity-item">
                                        <input type="checkbox" id="food" name="activities[]" value="food" class="activity-checkbox">
                                        <label for="food" class="activity-label text-center">
                                            <i class="fas fa-utensils activity-icon"></i> Food
                                        </label>
                                    </div>

                                    <div class="activity-item">
                                        <input type="checkbox" id="adventure" name="activities[]" value="adventure" class="activity-checkbox">
                                        <label for="adventure" class="activity-label text-center">
                                            <i class="fas fa-hiking activity-icon"></i> Adventure
                                        </label>
                            </div>

                                    <div class="activity-item">
                                        <input type="checkbox" id="relaxation" name="activities[]" value="relaxation" class="activity-checkbox">
                                        <label for="relaxation" class="activity-label text-center">
                                            <i class="fas fa-spa activity-icon"></i> Relaxation
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center pt-4">
                        <button type="submit" class="submit-button pulse">
                            <i class="fas fa-search mr-2"></i> Find My Perfect Destination
                        </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('.nav-container');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        const navToggle = document.querySelector('.nav-toggle');
        const navMenu = document.querySelector('.nav-menu');
        
        navToggle.addEventListener('click', function() {
            navToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', () => {
                navToggle.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });

        // Add date validation
        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');
        const startDateError = document.getElementById('start_date_error');
        const endDateError = document.getElementById('end_date_error');

        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        startDate.min = today;

        function validateDates() {
            let isValid = true;
            
            // Reset error states
            startDate.classList.remove('error');
            endDate.classList.remove('error');
            startDateError.style.display = 'none';
            endDateError.style.display = 'none';

            // Validate start date
            if (!startDate.value) {
                startDate.classList.add('error');
                startDateError.textContent = 'Please select a start date';
                startDateError.style.display = 'block';
                isValid = false;
            }

            // Validate end date
            if (!endDate.value) {
                endDate.classList.add('error');
                endDateError.textContent = 'Please select an end date';
                endDateError.style.display = 'block';
                isValid = false;
            }

            // Validate date range
            if (startDate.value && endDate.value) {
                const start = new Date(startDate.value);
                const end = new Date(endDate.value);
                
                if (end < start) {
                    endDate.classList.add('error');
                    endDateError.textContent = 'End date must be after start date';
                    endDateError.style.display = 'block';
                    isValid = false;
                }
            }

            return isValid;
        }

        startDate.addEventListener('change', () => {
            endDate.min = startDate.value;
            validateDates();
            updateProgress();
        });

        endDate.addEventListener('change', () => {
            validateDates();
            updateProgress();
        });

        // Budget slider functionality
        const budgetSlider = document.getElementById('budgetSlider');
        const budgetInput = document.getElementById('budget');
        const budgetValue = document.getElementById('budgetValue');

        budgetSlider.addEventListener('input', () => {
            const value = budgetSlider.value;
            budgetInput.value = value;
            budgetValue.textContent = `$${parseInt(value).toLocaleString()}`;
            updateProgress();
        });

        budgetInput.addEventListener('input', () => {
            const value = budgetInput.value;
            budgetSlider.value = value;
            budgetValue.textContent = `$${parseInt(value).toLocaleString()}`;
            updateProgress();
        });

        // Form validation and progress tracking
        const form = document.getElementById('recommendForm');
        const progressFill = document.getElementById('progressFill');
        const formSections = document.querySelectorAll('.form-section');
        
        // Show form sections with animation
        formSections.forEach((section, index) => {
            setTimeout(() => {
                section.classList.add('visible');
            }, 200 * index);
        });

        function updateProgress() {
            let progress = 0;
            
            // Check budget
            if (budgetInput.value) progress += 33;
            
            // Check dates
            if (startDate.value && endDate.value) progress += 33;
            
            // Check activities
            const activities = document.querySelectorAll('input[name="activities[]"]:checked');
            if (activities.length > 0) progress += 33;
            
            progressFill.style.width = `${progress}%`;
        }

        // Add form validation
        form.addEventListener('submit', (e) => {
            const activities = document.querySelectorAll('input[name="activities[]"]:checked');
            if (activities.length === 0) {
                e.preventDefault();
                alert('Please select at least one activity');
            }
            
            if (!validateDates()) {
                e.preventDefault();
            }
        });

        // Add activity selection animation
        const activityLabels = document.querySelectorAll('.activity-label');
        activityLabels.forEach(label => {
            label.addEventListener('click', () => {
                label.classList.add('pulse');
                setTimeout(() => {
                    label.classList.remove('pulse');
                }, 500);
                updateProgress();
            });
        });

        // Initialize progress
        updateProgress();

        // Add this to your existing JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            const nav = document.querySelector('.nav-container');
            const navToggle = document.querySelector('.nav-toggle');
            const navMenu = document.querySelector('.nav-menu');

            // Handle scroll effect
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    nav.classList.add('scrolled');
                } else {
                    nav.classList.remove('scrolled');
                }
            });

            // Handle mobile menu with animation
            navToggle.addEventListener('click', function() {
                navToggle.classList.toggle('active');
                navMenu.classList.toggle('active');
            });

            // Close mobile menu when clicking a link
            document.querySelectorAll('.nav-menu a').forEach(link => {
                link.addEventListener('click', () => {
                    navToggle.classList.remove('active');
                    navMenu.classList.remove('active');
                });
            });
        });
    </script>
</body>
</html> 