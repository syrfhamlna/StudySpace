@extends('layouts.app')

@section('title', 'Home | StudySpace')

@section('content')

<style>
    .home-page {
        color: #F5F5F7;
    }

    .hero {
        background: #1B1E25;
        border: 1px solid #2B303B;
        border-radius: 16px;
        padding: 58px 48px;
        color: #F5F5F7;
        margin-bottom: 42px;
    }

    .hero-content {
        max-width: 650px;
    }

    .hero-tag {
        display: inline-block;
        color: #8EAEFF;
        background: #252D3B;
        padding: 8px 13px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 1.8px;
        margin-bottom: 24px;
    }

    .hero h1 {
        font-size: 43px;
        line-height: 1.2;
        letter-spacing: -1.8px;
        font-weight: 700;
        margin-bottom: 17px;
        color: #F5F5F7;
    }

    .hero p {
        color: #A1A6B2;
        font-size: 14px;
        line-height: 1.9;
        max-width: 540px;
        margin-bottom: 27px;
    }

    .hero-button {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: #6C9BFF;
        color: #111827;
        padding: 13px 20px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: .2s;
    }

    .hero-button:hover {
        background: #8BB0FF;
        transform: translateY(-2px);
    }

    .section-title {
        font-size: 20px;
        font-weight: 650;
        letter-spacing: -.5px;
        color: #F0F1F4;
        margin-bottom: 8px;
    }

    .section-subtitle {
        color: #858B98;
        font-size: 12px;
        margin-bottom: 21px;
        line-height: 1.7;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 43px;
    }

    .stat-card {
        background: #1B1E25;
        border-radius: 12px;
        padding: 23px;
        border: 1px solid #2B303B;
        transition: .2s;
    }

    .stat-card:hover {
        border-color: #46536B;
        background: #20242D;
    }

    .stat-icon {
        width: 39px;
        height: 39px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #252D3B;
        font-size: 18px;
        margin-bottom: 18px;
    }

    .stat-card h3 {
        font-size: 29px;
        font-weight: 700;
        letter-spacing: -1px;
        color: #F5F5F7;
        margin-bottom: 6px;
    }

    .stat-card p {
        font-size: 12px;
        color: #9298A5;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-bottom: 30px;
    }

    .feature-card {
        background: #1B1E25;
        padding: 26px;
        border-radius: 12px;
        border: 1px solid #2B303B;
        transition: .2s;
    }

    .feature-card:hover {
        background: #20242D;
        border-color: #46536B;
        transform: translateY(-3px);
    }

    .feature-card h3 {
        font-size: 15px;
        font-weight: 650;
        color: #F0F1F4;
        margin-bottom: 10px;
    }

    .feature-card p {
        font-size: 12px;
        color: #9298A5;
        line-height: 1.8;
        margin-bottom: 19px;
    }

    .feature-link {
        color: #8EAEFF;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
    }

    .feature-link:hover {
        color: #B3CAFF;
    }

    .welcome-note {
        margin-top: 25px;
        padding: 19px 21px;
        background: #191D26;
        border: 1px solid #2B303B;
        border-left: 3px solid #6C9BFF;
        border-radius: 9px;
        color: #A8AFBD;
        font-size: 12px;
        line-height: 1.9;
    }

    .welcome-note strong {
        color: #F0F1F4;
    }

    @media(max-width: 700px) {
        .hero {
            padding: 38px 25px;
        }

        .hero h1 {
            font-size: 32px;
        }

        .dashboard-grid,
        .feature-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="home-page">

    <div class="hero">
        <div class="hero-content">
            <span class="hero-tag">YOUR LEARNING SPACE</span>

            <h1>Learn Better.<br>Achieve More.</h1>

            <p>
                Welcome to StudySpace, your personal learning management
                platform. Organise your courses, explore study materials
                and make your learning journey more productive.
            </p>

            <a href="/courses" class="hero-button">
                Explore Courses <span>→</span>
            </a>
        </div>
    </div>

    <h2 class="section-title">Your Learning Overview</h2>
    <p class="section-subtitle">
        Everything you need to manage your learning in one place.
    </p>

    <div class="dashboard-grid">
        <div class="stat-card">
            <div class="stat-icon">📚</div>
            <h3>{{ \App\Models\Course::count() }}</h3>
            <p>Total Courses</p>
        </div>

        <div class="stat-card">
            <div class="stat-icon">📁</div>
            <h3>{{ \App\Models\Material::count() }}</h3>
            <p>Study Materials</p>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🎓</div>
            <h3>24/7</h3>
            <p>Learning Access</p>
        </div>
    </div>

    <h2 class="section-title">Explore StudySpace</h2>
    <p class="section-subtitle">
        Choose a section to get started with your learning.
    </p>

    <div class="feature-grid">
        <div class="feature-card">
            <div class="stat-icon">📖</div>
            <h3>Course Management</h3>
            <p>
                Browse available courses, view course information
                and manage your learning subjects.
            </p>
            <a href="/courses" class="feature-link">
                View Courses →
            </a>
        </div>

        <div class="feature-card">
            <div class="stat-icon">🗂️</div>
            <h3>Study Resources</h3>
            <p>
                Access organised study materials including
                notes, PDF documents, videos and slides.
            </p>
            <a href="/materials" class="feature-link">
                Explore Materials →
            </a>
        </div>
    </div>

    <div class="welcome-note">
        <strong>StudySpace — Learn Without Limits.</strong><br>
        Stay organised, keep exploring and make every study session count.
    </div>

</div>

@endsection
