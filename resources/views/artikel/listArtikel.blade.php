<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>List Artikel</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }

    .bg-primary-green {
      background-color: #198754;
    }

    .text-primary-green {
      color: #198754;
    }

    .article-card {
      transition: all 0.3s ease;
      height: 100%;
      border-radius: 15px;
      overflow: hidden;
      background: white;
    }

    .article-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .article-image {
      height: 250px;
      object-fit: cover;
      transition: all 0.3s ease;
    }

    .article-card:hover .article-image {
      transform: scale(1.05);
    }

    .card-body {
      padding: 1.5rem;
    }

    .card-title {
      font-size: 1.25rem;
      color: #2d3436;
      margin-bottom: 1rem;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .card-text {
      color: #636e72;
      line-height: 1.6;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
      margin-bottom: 1.5rem;
    }

    .meta-info {
      font-size: 0.875rem;
      color: #b2bec3;
    }

    .read-more-btn {
      padding: 0.5rem 1.25rem;
      border-radius: 25px;
      font-weight: 500;
      transition: all 0.3s ease;
      border: 2px solid #198754;
    }

    .read-more-btn:hover {
      background-color: #198754;
      color: white;
      transform: translateX(5px);
    }

    .category-badge {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background-color: rgba(255, 255, 255, 0.9);
      padding: 0.5rem 1rem;
      border-radius: 25px;
      font-size: 0.875rem;
      font-weight: 500;
      color: #198754;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-primary-green navbar-dark">
    <div class="container">
      <a class="navbar-brand fw-bold" href="/">Logo</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link text-white-50" href="#">Get the App</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/articles">Articles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white-50" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white-50" href="#">About</a>
          </li>
        </ul>
        <div class="d-flex">
          @if (Auth::user())
            <div class="dropdown">
              <button class="btn text-white dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-2"></i>{{ Auth::user()->name }}
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <form method="POST" action="{{ route('logout') }}" class="px-3">
                    @csrf
                    <button type="submit" class="btn btn-link text-decoration-none text-dark p-0">
                      <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          @else
            <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Sign In</a>
            <a href="{{ route('register') }}" class="btn btn-light">Sign Up</a>
          @endif
        </div>
      </div>
    </div>
  </nav>

  <!-- Content -->
  <div class="container py-5">
    <h1 class="text-center mb-5 fw-bold">List Artikel</h1>

    <div class="row g-4">
      @forelse ($articles as $article)
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card article-card border-0 shadow-sm">
            <div class="position-relative">
              @if($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" 
                     class="article-image card-img-top" 
                     alt="{{ $article->title }}">
              @endif
              <span class="category-badge">Article</span>
            </div>
            <div class="card-body d-flex flex-column">
              <div class="mb-3">
                <div class="d-flex align-items-center meta-info mb-2">
                  <i class="fas fa-user-circle me-2"></i>
                  <span>{{ $article->user->name }}</span>
                  <span class="mx-2">•</span>
                  <i class="far fa-calendar-alt me-2"></i>
                  <span>{{ $article->created_at->format('d M Y') }}</span>
                </div>
                <h5 class="card-title">{{ $article->title }}</h5>
              </div>
              
              <p class="card-text flex-grow-1">{{ $article->content }}</p>
              
              <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('article.show', $article->id) }}" 
                   class="read-more-btn btn btn-outline-success">
                   Read More <i class="fas fa-arrow-right ms-2"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center">
          <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>Tidak ada artikel tersedia
          </div>
        </div>
      @endforelse
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
