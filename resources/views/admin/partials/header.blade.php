<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ URL::to('/admin/') }}">Products</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="/">Live</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CRUD</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ URL::to('admin/products') }}">View All Products</a>
                        <a class="dropdown-item" href="{{ URL::to('admin/products/create') }}">Create a Product</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ URL::to('admin/categories') }}">View Categories</a>
                        <a class="dropdown-item" href="{{ URL::to('admin/categories/create') }}">Create Category</a>
                    </div>
                </li>
            </ul>
            <a href="/">Live</a>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</div>