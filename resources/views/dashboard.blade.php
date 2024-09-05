@extends('layouts.layout')
@section("content")
<div class=" mt-2 mw-100 d-flex justify-content-center" style="background-color: #8B0000; height:70px;"><img src="{{ asset('pics/logo_burg.png') }}" alt="" ></div>
<div class=" h-70 mw-100 text-uppercase d-flex align-items-center justify-content-center " style="font-size: 45px ;font-weight:bold; background-color:#dcdcdc;">order online</div>
<br><br>
<div class="d-inline-flex ">
<a href="{{ route('food.category','burger') }}" class="boder rounded-circle p-3 mx-2"  id="a1" data-category="burger" style="background-color:#dcdcdc; text-decoration:none; color:black;">Burger</a>
<a href="{{ route('food.category','pizza') }}" class="boder rounded-circle p-3 mx-2 " id="a2" data-category="pizza" style="background-color:#dcdcdc; text-decoration:none; color:black;">Pizza</a>
<a href="{{ route('food.category','dessert') }}" class="boder rounded-circle p-3 mx-2" id="a3" data-category="dessert" style="background-color:#dcdcdc; text-decoration:none; color:black;">dessert</a>

</div>
<div class="container mt-4">
    <div class="row" id="food-container">
        <!-- Food items will be injected here by the AJAX call -->
    </div>
</div>
<script>

    var links = document.querySelectorAll('a[id^="a"]'); // Select all links with IDs starting with 'a'

    links.forEach(function(link) {
        link.addEventListener("click", function(e) {
            e.preventDefault();

            // Remove 'clicked' class from all links
            links.forEach(function(l) {
                l.classList.remove("clicked");
            });

            // Add 'clicked' class to the clicked link
            this.classList.add("clicked");
        });
    });

    document.querySelectorAll('a[data-category]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const category = this.getAttribute('data-category');

            // Perform an AJAX request to fetch food items by category
            fetch(`/foods/${category}`).then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        console.log("test",response)
        return response.json();
    })

                .then(data => {
                    // Clear the existing content
                    const foodContainer = document.getElementById('food-container');
                    foodContainer.innerHTML = '';

                    // Loop through the returned food items and append them to the container
                    data.foods.forEach(food => {
                        foodContainer.innerHTML += `
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <img src="/storage/${food.photo}" class="card-img-top" alt="${food.name}">
                                    <div class="card-body">
                                        <h5 class="card-title">${food.name}</h5>
                                        <p class="card-text">${food.description}</p>
                                        <p class="card-text"><strong>${food.price}</strong></p>
                                    </div>
                                </div>
                            </div>`;
                    });
                });
        });
    });

</script>
@endsection("content")
