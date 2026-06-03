<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pascasarjana Universitas Ngudi Waluyo</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #072b57;
            --primary-dark: #052044;
            --yellow: #f7b500;
            --white: #ffffff;
            --light: #f1f6f7;
            --text: #111827;
            --gold: #d9a935;
            --green: #78927a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--light);
            color: var(--text);
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        button {
            font-family: inherit;
        }

        .container {
            width: min(1120px, 92%);
            margin: 0 auto;
        }

        .top-header {
            width: 100%;
            background: #eef4f5;
            padding: 13px 0;
        }

        .brand-wrapper {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 14px;
            width: 100%;
        }

        .brand-logo {
            width: 58px;
            height: 58px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .brand-unw {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 14px;
            min-width: 0;
        }

        .brand-main {
            font-size: 42px;
            line-height: 1;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: 1px;
        }

        .brand-sub {
            margin-top: 4px;
            font-size: 8px;
            line-height: 1.2;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
        }

        .brand-divider {
            width: 2px;
            height: 43px;
            background: var(--primary);
            opacity: 0.7;
            flex-shrink: 0;
        }

        .brand-school {
            color: var(--primary);
            font-weight: 800;
            font-size: 16px;
            line-height: 1.25;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .navbar {
            background: var(--primary);
            min-height: 64px;
            position: relative;
            z-index: 100;
        }

        .nav-content {
            display: flex;
            align-items: center;
            min-height: 64px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            height: 64px;
        }

        .nav-item {
            position: relative;
            height: 100%;
        }

        .nav-link {
            height: 100%;
            padding: 0 17px;
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            font-weight: 700;
            color: var(--white);
            text-transform: uppercase;
            transition: 0.25s ease;
            white-space: nowrap;
            border: none;
            background: transparent;
            cursor: pointer;
        }

        .nav-link:hover,
        .nav-link.nav-click-active {
            background: var(--yellow);
            color: var(--white);
        }

        .nav-item.home-active .nav-link {
            color: var(--yellow);
            background: transparent;
        }

        .nav-item.home-active .nav-link:hover {
            color: var(--white);
            background: var(--yellow);
        }

        .nav-item.home-active::after {
            content: "";
            position: absolute;
            left: 16px;
            right: 16px;
            bottom: 0;
            height: 5px;
            border-radius: 8px 8px 0 0;
            background: var(--yellow);
        }

        .nav-item.home-active.hide-indicator::after {
            display: none;
        }

        .chevron {
            font-size: 12px;
            line-height: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transform: translateY(-1px);
        }

        .dropdown {
            position: absolute;
            top: 64px;
            left: 0;
            min-width: 255px;
            background: var(--white);
            border-radius: 0 0 6px 6px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.22);
            padding: 12px 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: 0.25s ease;
            z-index: 200;
        }

        .nav-item:hover .dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown a {
            display: block;
            padding: 10px 18px;
            font-size: 13px;
            font-weight: 600;
            color: #111827;
            transition: 0.2s ease;
        }

        .dropdown a:hover {
            background: #f3f4f6;
            color: var(--primary);
            padding-left: 23px;
        }

        .hamburger {
            display: none;
            margin-left: auto;
            width: 42px;
            height: 42px;
            border: none;
            background: transparent;
            cursor: pointer;
        }

        .hamburger span {
            display: block;
            width: 28px;
            height: 3px;
            background: var(--white);
            margin: 6px auto;
            border-radius: 10px;
        }

        .hero {
            position: relative;
            min-height: 360px;
            overflow: hidden;
            background: var(--primary-dark);
        }

        .hero-slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.7s ease;
            background-size: cover;
            background-position: center;
            z-index: 1;
        }

        .hero-slide.active {
            opacity: 1;
        }

        .hero-slide::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(90deg, rgba(7, 43, 87, 0.92), rgba(7, 43, 87, 0.88), rgba(7, 43, 87, 0.96)),
                linear-gradient(90deg, rgba(255,255,255,0.12), transparent 48%);
        }

        .hero-content {
            min-height: 360px;
            display: flex;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .hero-text {
            max-width: 740px;
            margin-left: 80px;
        }

        .hero-title {
            font-size: 36px;
            line-height: 1.25;
            font-weight: 800;
            color: var(--white);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .hero-subtitle {
            font-size: 19px;
            font-weight: 500;
            color: var(--white);
            margin-bottom: 20px;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 240px;
            height: 51px;
            padding: 0 24px;
            background: var(--yellow);
            color: var(--white);
            font-size: 17px;
            font-weight: 800;
            border-radius: 5px;
            text-transform: uppercase;
            box-shadow: 0 8px 18px rgba(247, 181, 0, 0.28);
            transition: 0.25s ease;
        }

        .btn-primary:hover {
            background: #d99f00;
            transform: translateY(-2px);
        }

        .hero-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.92);
            color: var(--primary);
            font-size: 24px;
            font-weight: 700;
            cursor: pointer;
            z-index: 5;
            transition: 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }

        .hero-arrow:hover {
            background: var(--yellow);
            color: var(--white);
        }

        .hero-arrow.left {
            left: clamp(22px, 7vw, 96px);
        }

        .hero-arrow.right {
            right: clamp(22px, 7vw, 96px);
        }

        .hero-dots {
            position: absolute;
            left: 50%;
            bottom: 18px;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 6;
        }

        .hero-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: none;
            background: #e5e7eb;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .hero-dot.active {
            background: var(--yellow);
        }

        .program-section {
            position: relative;
            padding: 45px 0 38px;
            background: #eef5f6;
        }

        .program-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 22px;
        }

        .program-card {
            background: var(--white);
            min-height: 145px;
            border-radius: 6px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.20);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            padding: 18px 14px;
            transition: 0.25s ease;
        }

        .program-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        .program-icon {
            height: 42px;
            margin-bottom: 12px;
            color: var(--gold);
        }

        .program-icon svg {
            width: 48px;
            height: 48px;
            fill: currentColor;
        }

        .program-title {
            font-size: 15px;
            line-height: 1.12;
            font-weight: 800;
            color: #050505;
            margin-bottom: 9px;
        }

        .program-detail {
            font-size: 12px;
            color: #6d8a65;
            font-weight: 500;
        }

        .info-section {
            background: #ffffff;
            padding: 18px 0 52px;
        }

        .info-layout {
            display: grid;
            grid-template-columns: 1.35fr 0.95fr;
            gap: 42px;
            align-items: start;
        }

        .news-area {
            padding-right: 36px;
            border-right: 1px solid #d1d1d1;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 25px;
            line-height: 1.2;
            font-weight: 800;
            color: #050505;
            text-transform: uppercase;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
            font-size: 13px;
            color: #222;
        }

        .page-btn,
        .page-number {
            width: 24px;
            height: 24px;
            border-radius: 5px;
            border: 1px solid #9ca3af;
            background: #ffffff;
            color: #111827;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .page-btn {
            border-color: transparent;
            background: var(--yellow);
            color: #ffffff;
            font-weight: 800;
        }

        .page-btn.dark {
            background: var(--primary);
        }

        .page-number.active,
        .page-number:hover,
        .page-btn:hover {
            background: var(--yellow);
            border-color: var(--yellow);
            color: #111827;
        }

        .page-btn.dark:hover {
            background: #021b3b;
            color: #ffffff;
        }

        .news-list {
            display: flex;
            flex-direction: column;
        }

        .news-item {
            display: grid;
            grid-template-columns: 160px 1fr;
            gap: 22px;
            padding: 14px 2px 16px;
            border-bottom: 1px solid #d1d1d1;
        }

        .news-thumb {
            height: 94px;
            border-radius: 8px;
            background: #d9d9d9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .news-thumb svg {
            width: 54px;
            height: 54px;
            fill: #050505;
        }

        .news-category {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            line-height: 1.2;
            font-weight: 700;
            color: var(--green);
            margin-bottom: 4px;
        }

        .news-category svg {
            width: 14px;
            height: 14px;
            fill: currentColor;
        }

        .news-title {
            font-size: 18px;
            line-height: 1.18;
            font-weight: 800;
            color: #050505;
            margin-bottom: 8px;
        }

        .news-date {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #686868;
            font-size: 15px;
            font-weight: 700;
        }

        .news-date svg {
            width: 15px;
            height: 15px;
            fill: currentColor;
        }

        .service-area {
            position: relative;
        }

        .service-title {
            margin-bottom: 36px;
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(135px, 1fr));
            gap: 20px 14px;
            align-items: stretch;
        }

        .service-card {
            width: 100%;
            min-height: 116px;
            border: none;
            border-radius: 7px;
            background: #ffffff;
            color: #050505;
            box-shadow: 0 5px 14px rgba(0, 0, 0, 0.24);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 9px;
            text-align: center;
            cursor: pointer;
            transition: 0.25s ease;
            padding: 15px;
        }

        .service-card:hover {
            background: var(--yellow);
            color: #ffffff;
            transform: translateY(-3px);
        }

        .service-card svg {
            width: 42px;
            height: 42px;
            fill: var(--yellow);
            transition: 0.25s ease;
        }

        .service-card:hover svg {
            fill: #ffffff;
        }

        .service-card span {
            font-size: 15px;
            line-height: 1.15;
            font-weight: 800;
            text-transform: uppercase;
        }

        .edom-card-wrapper {
            position: relative;
            width: 100%;
            min-height: 116px;
            display: flex;
        }

        .edom-card-wrapper .service-card {
            width: 100%;
            height: 100%;
            min-height: 116px;
            flex: 1;
        }

        .edom-card-wrapper:hover .edom-popover,
        .edom-card-wrapper.show-popover .edom-popover {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
            pointer-events: auto;
        }

        .edom-card-wrapper:hover .service-card,
        .edom-card-wrapper.show-popover .service-card {
            background: var(--yellow);
            color: #ffffff;
            transform: translateY(-3px);
        }

        .edom-card-wrapper:hover .service-card svg,
        .edom-card-wrapper.show-popover .service-card svg {
            fill: #ffffff;
        }

        .edom-popover {
            position: absolute;
            top: calc(100% + 14px);
            left: 50%;
            transform: translateX(-50%) translateY(8px);
            width: 230px;
            background: #ffffff;
            border-radius: 9px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.24);
            padding: 16px 14px;
            z-index: 30;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: 0.22s ease;
        }

        .edom-popover::before {
            content: "";
            position: absolute;
            top: -13px;
            left: 50%;
            transform: translateX(-50%);
            border-left: 12px solid transparent;
            border-right: 12px solid transparent;
            border-bottom: 13px solid #ffffff;
        }

        .edom-popover h4 {
            font-size: 13px;
            line-height: 1.25;
            font-weight: 800;
            margin-bottom: 12px;
            color: #050505;
        }

        .edom-popover p {
            font-size: 12px;
            line-height: 1.35;
            color: #050505;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .edom-popover .small-label {
            font-size: 11px;
            line-height: 1.3;
            color: #777;
            margin-bottom: 9px;
        }

        .edom-score {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .edom-score span {
            width: 24px;
            height: 24px;
            border-radius: 5px;
            background: #e5e5e5;
            color: #111;
            font-size: 13px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 1200px) {
            .container {
                width: min(100% - 40px, 1120px);
            }

            .nav-link {
                padding: 0 12px;
                font-size: 11px;
            }

            .hero-text {
                margin-left: 58px;
            }

            .info-layout {
                grid-template-columns: 1.25fr 0.9fr;
                gap: 32px;
            }
        }

        @media (max-width: 992px) {
            .container {
                width: min(100% - 32px, 1120px);
            }

            .top-header {
                padding: 10px 0;
            }

            .brand-wrapper {
                justify-content: flex-start;
                gap: 12px;
            }

            .brand-main {
                font-size: 34px;
            }

            .brand-school {
                font-size: 13px;
            }

            .navbar {
                min-height: 64px;
            }

            .nav-content {
                min-height: 64px;
                flex-wrap: wrap;
            }

            .hamburger {
                display: block;
            }

            .nav-menu {
                display: none;
                width: 100%;
                height: auto;
                flex-direction: column;
                align-items: stretch;
                padding: 8px 0 14px;
            }

            .nav-menu.show {
                display: flex;
            }

            .nav-item {
                height: auto;
                width: 100%;
            }

            .nav-link {
                width: 100%;
                height: 48px;
                padding: 0 14px;
                justify-content: space-between;
                font-size: 12px;
                background: transparent;
                color: var(--white);
            }

            .nav-link:hover {
                background: transparent;
                color: var(--white);
            }

            .nav-link.nav-click-active {
                background: var(--yellow);
                color: var(--white);
            }

            .nav-item.home-active .nav-link {
                color: var(--yellow);
                background: transparent;
            }

            .nav-item.home-active .nav-link:hover {
                color: var(--yellow);
                background: transparent;
            }

            .nav-item.home-active::after {
                display: none;
            }

            .dropdown {
                position: static;
                min-width: 100%;
                box-shadow: none;
                border-radius: 0;
                opacity: 1;
                visibility: visible;
                transform: none;
                display: none;
                padding: 5px 0;
                background: #ffffff;
            }

            .nav-item:hover .dropdown {
                display: none;
            }

            .nav-item.open .dropdown {
                display: block;
            }

            .dropdown a {
                padding: 11px 20px;
                font-size: 12px;
            }

            .hero {
                min-height: 340px;
            }

            .hero-content {
                min-height: 340px;
            }

            .hero-text {
                margin-left: 42px;
                max-width: 620px;
            }

            .hero-title {
                font-size: 30px;
            }

            .hero-subtitle {
                font-size: 17px;
            }

            .hero-arrow.left {
                left: clamp(16px, 4vw, 42px);
            }

            .hero-arrow.right {
                right: clamp(16px, 4vw, 42px);
            }

            .program-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .info-layout {
                grid-template-columns: 1fr;
                gap: 42px;
            }

            .news-area {
                padding-right: 0;
                border-right: none;
            }

            .service-title {
                margin-bottom: 22px;
            }

            .service-grid {
                grid-template-columns: repeat(2, minmax(180px, 1fr));
                gap: 22px;
            }

            .edom-popover {
                width: 230px;
            }
        }

        @media (max-width: 768px) {
            .brand-logo {
                width: 52px;
                height: 52px;
            }

            .brand-unw {
                gap: 10px;
            }

            .brand-main {
                font-size: 31px;
            }

            .brand-school {
                font-size: 12px;
            }

            .brand-divider {
                height: 38px;
            }

            .hero {
                min-height: 330px;
            }

            .hero-content {
                min-height: 330px;
            }

            .hero-text {
                margin-left: 0;
                padding: 0 44px;
            }

            .hero-title {
                font-size: 27px;
            }

            .hero-subtitle {
                font-size: 15px;
            }

            .btn-primary {
                min-width: 210px;
                height: 47px;
                font-size: 15px;
            }

            .hero-arrow {
                width: 36px;
                height: 36px;
                font-size: 21px;
            }

            .hero-arrow.left {
                left: 16px;
            }

            .hero-arrow.right {
                right: 16px;
            }

            .hero-dot {
                width: 12px;
                height: 12px;
            }

            .program-section {
                padding: 34px 0;
            }

            .program-card {
                min-height: 138px;
            }

            .info-section {
                padding: 26px 0 44px;
            }

            .section-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .pagination {
                flex-wrap: wrap;
            }

            .news-item {
                grid-template-columns: 140px 1fr;
                gap: 16px;
            }

            .news-title {
                font-size: 16px;
            }

            .news-date {
                font-size: 13px;
            }
        }

        @media (max-width: 640px) {
            .container {
                width: min(100% - 28px, 1120px);
            }

            .top-header {
                padding: 9px 0;
            }

            .brand-wrapper {
                justify-content: flex-start;
                gap: 9px;
            }

            .brand-logo {
                width: 46px;
                height: 46px;
            }

            .brand-unw {
                gap: 8px;
            }

            .brand-main {
                font-size: 28px;
            }

            .brand-sub {
                font-size: 6.5px;
            }

            .brand-divider {
                width: 1.5px;
                height: 34px;
            }

            .brand-school {
                font-size: 10px;
                white-space: normal;
            }

            .hamburger {
                width: 40px;
                height: 40px;
            }

            .hamburger span {
                width: 26px;
                height: 3px;
            }

            .hero {
                min-height: 315px;
            }

            .hero-content {
                min-height: 315px;
            }

            .hero-text {
                padding: 0 32px;
                text-align: left;
            }

            .hero-title {
                font-size: 23px;
                line-height: 1.28;
            }

            .hero-subtitle {
                font-size: 14px;
                line-height: 1.45;
                margin-bottom: 16px;
            }

            .btn-primary {
                min-width: 185px;
                height: 44px;
                padding: 0 18px;
                font-size: 13px;
            }

            .hero-arrow {
                width: 32px;
                height: 32px;
                font-size: 19px;
            }

            .hero-arrow.left {
                left: 10px;
            }

            .hero-arrow.right {
                right: 10px;
            }

            .hero-dots {
                bottom: 13px;
                gap: 7px;
            }

            .hero-dot {
                width: 11px;
                height: 11px;
            }

            .program-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .program-card {
                min-height: 130px;
            }

            .section-title {
                font-size: 21px;
                line-height: 1.25;
            }

            .pagination {
                gap: 6px;
            }

            .page-btn,
            .page-number {
                width: 23px;
                height: 23px;
                font-size: 12px;
            }

            .news-item {
                grid-template-columns: 1fr;
                gap: 12px;
                padding: 14px 0 18px;
            }

            .news-thumb {
                width: 100%;
                height: 155px;
            }

            .news-title {
                font-size: 15px;
                line-height: 1.35;
            }

            .news-category {
                font-size: 13px;
            }

            .news-date {
                font-size: 13px;
            }

            .service-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .service-card {
                min-height: 112px;
            }

            .edom-card-wrapper,
            .edom-card-wrapper .service-card {
                width: 100%;
                min-height: 112px;
            }

            .edom-popover {
                width: min(260px, calc(100vw - 48px));
                padding: 16px 14px;
            }

            .edom-score {
                gap: 7px;
                flex-wrap: wrap;
            }

            .edom-score span {
                width: 26px;
                height: 26px;
                font-size: 13px;
            }
        }

        @media (max-width: 420px) {
            .brand-wrapper {
                align-items: center;
            }

            .brand-school,
            .brand-divider {
                display: none;
            }

            .hero-text {
                padding: 0 26px;
            }

            .hero-title {
                font-size: 20px;
            }

            .hero-subtitle {
                font-size: 13px;
            }

            .btn-primary {
                min-width: 170px;
                height: 42px;
                font-size: 12px;
            }

            .hero-arrow {
                width: 29px;
                height: 29px;
            }

            .hero-arrow.left {
                left: 8px;
            }

            .hero-arrow.right {
                right: 8px;
            }
        }
    </style>
</head>
<body>

<header class="top-header">
    <div class="container">
        <div class="brand-wrapper">
            <img src="{{ asset('assets/images/logo-unw.png') }}" alt="Logo UNW" class="brand-logo">

            <div class="brand-unw">
                <div>
                    <div class="brand-main">UNW</div>
                    <div class="brand-sub">
                        Universitas Ngudi Waluyo<br>
                        Pasca Sarjana
                    </div>
                </div>

                <div class="brand-divider"></div>

                <div class="brand-school">
                    Postgraduate School<br>
                    Univcasarjana
                </div>
            </div>
        </div>
    </div>
</header>

<nav class="navbar">
    <div class="container">
        <div class="nav-content">
            <button class="hamburger" id="hamburger" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <ul class="nav-menu" id="navMenu">
                <li class="nav-item home-active" id="homeNavItem">
                    <a href="{{ route('home') }}" class="nav-link" data-nav="home">Beranda</a>
                </li>

                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link dropdown-trigger">
                        Profile <span class="chevron">⌄</span>
                    </a>
                    <div class="dropdown">
                        <a href="#">Tentang Pascasarjana</a>
                        <a href="#">Visi dan Misi</a>
                        <a href="#">Struktur Organisasi</a>
                    </div>
                </li>

                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link dropdown-trigger">
                        Akademik <span class="chevron">⌄</span>
                    </a>
                    <div class="dropdown">
                        <a href="#">Magister Hukum</a>
                        <a href="#">Magister Manajemen Pendidikan</a>
                        <a href="#">Magister Kesehatan Masyarakat</a>
                        <a href="#">Magister Keperawatan</a>
                    </div>
                </li>

                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link dropdown-trigger">
                        Penjaminan Mutu <span class="chevron">⌄</span>
                    </a>
                    <div class="dropdown">
                        <a href="#">Dokumen SPMI</a>
                        <a href="#">Laporan AMI</a>
                        <a href="#">Penjaminan Digital</a>
                    </div>
                </li>

                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link dropdown-trigger">
                        Riset & PDM <span class="chevron">⌄</span>
                    </a>
                    <div class="dropdown">
                        <a href="#">Riset Dosen</a>
                        <a href="#">Publikasi</a>
                        <a href="#">Pengabdian Masyarakat</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="#layanan-mahasiswa" class="nav-link" id="edomNav" data-nav="edom">Edom</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">Admisi</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="hero">
    <div class="hero-slide active" style="background-image: url('{{ asset('assets/images/hero-campus.png') }}');"></div>
    <div class="hero-slide" style="background-image: url('{{ asset('assets/images/hero-campus.png') }}');"></div>
    <div class="hero-slide" style="background-image: url('{{ asset('assets/images/hero-campus.png') }}');"></div>
    <div class="hero-slide" style="background-image: url('{{ asset('assets/images/hero-campus.png') }}');"></div>

    <button class="hero-arrow left" id="prevSlide" type="button" aria-label="Slide sebelumnya">‹</button>
    <button class="hero-arrow right" id="nextSlide" type="button" aria-label="Slide berikutnya">›</button>

    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">
                    Pascasarjana<br>
                    Universitas Ngudi Waluyo
                </h1>

                <p class="hero-subtitle">
                    Pascasarjana Universitas Ngudi Waluyo
                </p>

                <a href="#" class="btn-primary">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </div>

    <div class="hero-dots" id="heroDots">
        <button class="hero-dot active" type="button" aria-label="Slide 1"></button>
        <button class="hero-dot" type="button" aria-label="Slide 2"></button>
        <button class="hero-dot" type="button" aria-label="Slide 3"></button>
        <button class="hero-dot" type="button" aria-label="Slide 4"></button>
    </div>
</section>

<section class="program-section">
    <div class="container">
        <div class="program-grid">

            <a href="#" class="program-card">
                <div class="program-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 3h2v3h4v2h-1.2l2.7 6.1c-.8 1.2-2.1 1.9-3.5 1.9s-2.7-.7-3.5-1.9L15.2 8H14v10h4v2H6v-2h4V8H8.8l2.7 6.1C10.7 15.3 9.4 16 8 16s-2.7-.7-3.5-1.9L7.2 8H6V6h4V3h2Zm-4 7.2L6.6 13h2.8L8 10.2Zm8 0L14.6 13h2.8L16 10.2Z"/>
                    </svg>
                </div>
                <h3 class="program-title">Magister<br>Hukum</h3>
                <span class="program-detail">Detail</span>
            </a>

            <a href="#" class="program-card">
                <div class="program-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 3 1 9l11 6 9-4.91V17h2V9L12 3Zm0 14.2L5 13.4V17l7 4 7-4v-3.6l-7 3.8Z"/>
                    </svg>
                </div>
                <h3 class="program-title">Magister Manajemen<br>Pendidikan</h3>
                <span class="program-detail">Detail</span>
            </a>

            <a href="#" class="program-card">
                <div class="program-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 21s-7.5-4.6-9.7-9.2C.6 8.2 2.6 4 6.5 4c2.2 0 3.7 1.2 4.5 2.6C11.8 5.2 13.3 4 15.5 4c3.9 0 5.9 4.2 4.2 7.8C17.5 16.4 12 21 12 21Zm-1.3-7.7h2.6v-2.1h2.1V8.6h-2.1V6.5h-2.6v2.1H8.6v2.6h2.1v2.1Z"/>
                    </svg>
                </div>
                <h3 class="program-title">Magister Kesehatan<br>Masyarakat</h3>
                <span class="program-detail">Detail</span>
            </a>

            <a href="#" class="program-card">
                <div class="program-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2 6 4v5c0 3.7 2.5 7.1 6 8 3.5-.9 6-4.3 6-8V4l-6-2Zm1 3v2h2v2h-2v2h-2V9H9V7h2V5h2Zm-8 14c0-2.2 4.7-3.4 7-3.4s7 1.2 7 3.4V22H5v-3Z"/>
                    </svg>
                </div>
                <h3 class="program-title">Magister<br>Keperawatan</h3>
                <span class="program-detail">Detail</span>
            </a>

        </div>
    </div>
</section>

<section class="info-section" id="layanan-mahasiswa">
    <div class="container">
        <div class="info-layout">

            <div class="news-area">
                <div class="section-header">
                    <h2 class="section-title">Berita Terkini & Agenda</h2>

                    <div class="pagination">
                        <button class="page-btn" type="button">‹</button>
                        <button class="page-number active" type="button">1</button>
                        <button class="page-number" type="button">2</button>
                        <button class="page-number" type="button">3</button>
                        <span>......</span>
                        <button class="page-number" type="button">10</button>
                        <button class="page-btn dark" type="button">›</button>
                    </div>
                </div>

                <div class="news-list">
                    @for ($i = 0; $i < 4; $i++)
                        <article class="news-item">
                            <div class="news-thumb">
                                <svg viewBox="0 0 24 24">
                                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2ZM8.5 11.5l2.5 3.01L14.5 10l4.5 6H5l3.5-4.5Z"/>
                                </svg>
                            </div>

                            <div class="news-content">
                                <div class="news-category">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M20.59 13.41 12 22l-8.59-8.59A2 2 0 0 1 3 12V4a1 1 0 0 1 1-1h8a2 2 0 0 1 1.41.59L22 12.17l-1.41 1.24ZM7.5 8A1.5 1.5 0 1 0 7.5 5 1.5 1.5 0 0 0 7.5 8Z"/>
                                    </svg>
                                    Lorem, Ipsum
                                </div>

                                <h3 class="news-title">
                                    Lorem Ipsum Dolor Sit Amet Consectetur Adipiscing Elit Sed Do Eiusmod Tempor
                                </h3>

                                <div class="news-date">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M7 2h2v2h6V2h2v2h3a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3V2Zm12 8H5v10h14V10ZM5 8h14V6H5v2Zm2 4h3v3H7v-3Zm5 0h3v3h-3v-3Z"/>
                                    </svg>
                                    03 Juni 2026
                                </div>
                            </div>
                        </article>
                    @endfor
                </div>
            </div>

            <div class="service-area">
                <h2 class="section-title service-title">Menu Layanan Mahasiswa</h2>

                <div class="service-grid">
                    <button class="service-card" type="button">
                        <svg viewBox="0 0 24 24">
                            <path d="M10 17v-3H3v-4h7V7l5 5-5 5ZM12 3h8a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1h-8v-2h7V5h-7V3Z"/>
                        </svg>
                        <span>Login<br>Mahasiswa</span>
                    </button>

                    <div class="edom-card-wrapper" id="edomCardWrapper">
                        <button class="service-card" type="button" id="edomService">
                            <svg viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6Zm-1 7V3.5L18.5 9H13ZM8 13h8v2H8v-2Zm0 4h8v2H8v-2Zm0-8h3v2H8V9Z"/>
                            </svg>
                            <span>EDOM</span>
                        </button>

                        <div class="edom-popover">
                            <h4>Pilih Mata Kuliah :</h4>
                            <p>Kejelasan Penyampaian Materi Dosen?</p>
                            <div class="small-label">Kejelasan Penyampaian Materi Dosen?</div>
                            <div class="edom-score">
                                <span>1</span>
                                <span>2</span>
                                <span>3</span>
                                <span>4</span>
                                <span>5</span>
                            </div>
                        </div>
                    </div>

                    <button class="service-card" type="button">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 3 1 9l11 6 9-4.91V17h2V9L12 3Zm0 14.2L5 13.4V17l7 4 7-4v-3.6l-7 3.8Z"/>
                        </svg>
                        <span>E-Learning</span>
                    </button>

                    <button class="service-card" type="button">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 3 1 9l11 6 9-4.91V17h2V9L12 3Zm0 14.2L5 13.4V17l7 4 7-4v-3.6l-7 3.8Z"/>
                        </svg>
                        <span>Perpustakaan<br>Digital</span>
                    </button>

                    <button class="service-card" type="button">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 3 1 9l11 6 9-4.91V17h2V9L12 3Zm0 14.2L5 13.4V17l7 4 7-4v-3.6l-7 3.8Z"/>
                        </svg>
                        <span>E-Learning</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('navMenu');

    hamburger.addEventListener('click', function () {
        navMenu.classList.toggle('show');
    });

    const dropdownTriggers = document.querySelectorAll('.dropdown-trigger');

    dropdownTriggers.forEach((trigger) => {
        trigger.addEventListener('click', function (event) {
            if (window.innerWidth <= 992) {
                event.preventDefault();

                const currentItem = trigger.closest('.nav-item');

                document.querySelectorAll('.nav-item.has-dropdown').forEach((item) => {
                    if (item !== currentItem) {
                        item.classList.remove('open');
                    }
                });

                currentItem.classList.toggle('open');
            }
        });
    });

    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    const prevSlide = document.getElementById('prevSlide');
    const nextSlide = document.getElementById('nextSlide');

    let currentSlide = 0;
    let slideInterval;

    function showSlide(index) {
        slides.forEach((slide) => slide.classList.remove('active'));
        dots.forEach((dot) => dot.classList.remove('active'));

        currentSlide = (index + slides.length) % slides.length;

        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
    }

    function goToNextSlide() {
        showSlide(currentSlide + 1);
    }

    function goToPrevSlide() {
        showSlide(currentSlide - 1);
    }

    function startAutoSlide() {
        slideInterval = setInterval(goToNextSlide, 2500);
    }

    function resetAutoSlide() {
        clearInterval(slideInterval);
        startAutoSlide();
    }

    nextSlide.addEventListener('click', function () {
        goToNextSlide();
        resetAutoSlide();
    });

    prevSlide.addEventListener('click', function () {
        goToPrevSlide();
        resetAutoSlide();
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', function () {
            showSlide(index);
            resetAutoSlide();
        });
    });

    startAutoSlide();

    const edomNav = document.getElementById('edomNav');
    const homeNavItem = document.getElementById('homeNavItem');
    const navLinks = document.querySelectorAll('.nav-link');
    const edomCardWrapper = document.getElementById('edomCardWrapper');
    const edomService = document.getElementById('edomService');

    edomNav.addEventListener('click', function () {
        navLinks.forEach((link) => link.classList.remove('nav-click-active'));
        edomNav.classList.add('nav-click-active');
        homeNavItem.classList.add('hide-indicator');

        if (window.innerWidth <= 992) {
            navMenu.classList.remove('show');
            document.querySelectorAll('.nav-item.has-dropdown').forEach((item) => {
                item.classList.remove('open');
            });
        }
    });

    edomService.addEventListener('click', function (event) {
        if (window.innerWidth <= 992) {
            event.preventDefault();
            edomCardWrapper.classList.toggle('show-popover');
        }
    });

    document.addEventListener('click', function (event) {
        if (window.innerWidth <= 992 && !edomCardWrapper.contains(event.target)) {
            edomCardWrapper.classList.remove('show-popover');
        }
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 992) {
            navMenu.classList.remove('show');

            document.querySelectorAll('.nav-item.has-dropdown').forEach((item) => {
                item.classList.remove('open');
            });

            edomCardWrapper.classList.remove('show-popover');
        }
    });
</script>

</body>
</html>