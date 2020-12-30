@extends('frontend.layouts.master')



<main role="main">

    @include('frontend.layouts.slider')

    @section('content')
        <div class="container">
            <h3><u>Mission and Vission</u></h3>

            {{--Mission and Vision--}}
            <div class="row">
                <div class="col-6">
                    <img src="" class="img-thumbnail rounded" alt="Mission and vision image">
                    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                </div>
                <div class="col-6">
                    <img src="" class="img-thumbnail rounded" alt="Mission and vision image">
                    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                </div>
            </div>

            <!-- News and Events -->
            <div class="row mt-5">
                <div class="col-4">
                    <h3><u>News and Events</u></h3>
                </div>
                <div class="col-8">
                    <table class="table">
                        <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Date</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection






</main>


