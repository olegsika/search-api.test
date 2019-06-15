<template>
    <div class="container">
        <h2>Search</h2>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-12 p-0">
                                <label for="name">Name</label>
                                <input type="text" @keyup.enter="searchIt" name="name" id="name" v-model='search.name' class="form-control search-slt" placeholder="Enter Name">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                <label for="bedrooms">Bedrooms</label>
                                <input type="number" min="0" @keyup.enter="searchIt" name="bedrooms" v-model='search.bedrooms' id="bedrooms" class="form-control search-slt" placeholder="Bedrooms">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                <label for="bathrooms">Bathrooms</label>
                                <input type="number" min="0" @keyup.enter="searchIt" name="bathrooms" v-model='search.bathrooms' id="bathrooms" class="form-control search-slt" placeholder="Bathrooms">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                <label for="storeys">Storeys</label>
                                <input type="number" min="0" @keyup.enter="searchIt" name="storeys" v-model='search.storeys' id="storeys" class="form-control search-slt" placeholder="Storeys">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                <label for="garages">Garages</label>
                                <input type="number" min="0" @keyup.enter="searchIt" name="garages" v-model='search.garages' id="garages" class="form-control search-slt" placeholder="Garages">
                            </div>
                            <div class="col-lg-1 col-md-2 col-sm-12 p-0">
                                <label for="minPrice">Min Price</label>
                                <input type="number" min="1" @keyup.enter="searchIt" name="minPrice" v-model='search.minPrice' id="minPrice" class="form-control search-slt" placeholder="MinPrice">
                            </div>
                            <div class="col-lg-1 col-md-2 col-sm-12 p-0">
                                <label for="maxPrice">Max Price</label>
                                <input type="number" min="1" @keyup.enter="searchIt" name="maxPrice" v-model='search.maxPrice' id="maxPrice" class="form-control search-slt" placeholder="MaxPrice">
                            </div>

                        </div>
                        <div class="mt-2">
                            <button type="button" @click="searchIt" class="btn btn-danger wrn-btn">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                <h2>Result</h2>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Bedrooms</th>
                        <th>Bathrooms</th>
                        <th>Storeys</th>
                        <th>Garages</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="hotel in hotels" :key="hotel.id">
                        <td>{{ hotel.name }}</td>
                        <td>{{ hotel.price }}</td>
                        <td>{{ hotel.bedrooms }}</td>
                        <th>{{ hotel.bathrooms }}</th>
                        <th>{{ hotel.storeys }}</th>
                        <th>{{ hotel.garages }}</th>
                    </tr>
                    </tbody></table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                hotels: {},
                search: {
                    'name': '',
                    'bedrooms': '',
                    'bathrooms': '',
                    'storeys': '',
                    'garages': '',
                    'minPrice': '',
                    'maxPrice': '',
                }
            }
        },
        methods: {
            loadHotels(){
                axios.get('api/get').then(({data}) => (this.hotels = data))
            },
            searchIt() {
                axios.put('api/search', this.search)
                    .then((responce) => {
                        if(responce.data.length > 0) {
                            this.hotels = responce.data;
                        }else {
                            alert('No Data');
                        }
                    })
            }
        },
        created() {
            this.loadHotels();
        }
    }
</script>
