<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee's Web</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('exam') }}">TOEFL EXAM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user"></i> User
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="width: 100%; height: 100vh;">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner" style="height: 100%;">
            <div class="carousel-item active">
                <img class="d-block w-100" src="https://img.freepik.com/free-photo/abstract-blur-hotel-interior_1203-8547.jpg?t=st=1733231319~exp=1733234919~hmac=259463eeb4de055cac5ac15818af7dd579f4fd85d2b434e0c2ad0c28bf594a7d&w=1380" alt="First slide" style="object-fit: cover; height: 100vh;">
                <div class="carousel-caption">
                    <h5>Welcome to Winnicode</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://img.freepik.com/free-photo/abstract-blur-hotel-interior_1203-8529.jpg?t=st=1733231119~exp=1733234719~hmac=0a955beaa5a2e099c74b42e5dc9a00067d98472fde8d9146804e21e83de75415&w=1380" alt="Second slide" style="object-fit: cover; height: 100vh;">
                <div class="carousel-caption">
                    <h5>Explore Our Collection</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://img.freepik.com/free-photo/abstract-blur-hotel-interior_1203-8546.jpg?t=st=1733231244~exp=1733234844~hmac=8aff075c6edc6d4cb18ca7299ab1f744adf20d21bcd2f797368bd615b2afd1ee&w=1380" alt="Third slide" style="object-fit: cover; height: 100vh;">
                <div class="carousel-caption">
                    <h5>Find Your TOEFL score</h5>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

</body>
</html>
