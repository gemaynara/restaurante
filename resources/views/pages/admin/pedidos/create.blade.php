@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Fazer Pedido</h4>
                        <p class="card-description">Add class <code>.nav-pills-custom</code> and <code>.tab-content-custom-pill</code> to <code>.nav-pills</code> and <code>.tab-content</code></p>
                        <div class="row">
                            <div class="col-md-12 mx-auto">
                                <ul class="nav nav-pills nav-pills-custom" id="pills-tab-custom" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-home-tab-custom" data-bs-toggle="pill" href="#pills-health" role="tab" aria-controls="pills-home" aria-selected="false">
                                            Health
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab-custom" data-bs-toggle="pill" href="#pills-career" role="tab" aria-controls="pills-profile" aria-selected="false">
                                            Career
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-contact-tab-custom" data-bs-toggle="pill" href="#pills-music" role="tab" aria-controls="pills-contact" aria-selected="false">
                                            Music
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-vibes-tab-custom" data-bs-toggle="pill" href="#pills-vibes" role="tab" aria-controls="pills-contact" aria-selected="false">
                                            Vibes
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-energy-tab-custom" data-bs-toggle="pill" href="#pills-energy" role="tab" aria-controls="pills-contact" aria-selected="true">
                                            Energy
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom">
                                    <div class="tab-pane fade" id="pills-health" role="tabpanel" aria-labelledby="pills-home-tab-custom">
                                        <div class="d-flex mb-4">
                                            <img src="../../../../images/samples/300x300/12.jpg" class="w-25 h-100 rounded" alt="sample image">
                                            <img src="../../../../images/samples/300x300/1.jpg" class="w-25 h-100 ms-4 rounded" alt="sample image">
                                            <img src="../../../../images/samples/300x300/2.jpg" class="w-25 h-100 ms-4 rounded" alt="sample image">
                                        </div>
                                        <p>
                                            I'm not the monster he wants me to be. So I'm neither man nor beast. I'm something new entirely. With
                                            my own set of rules. I'm Dexter. Boo. Only you could make those words cute. I'm thinking two circus clowns dancing. You?
                                        </p>
                                        <p>
                                            Under normal circumstances, I'd take that as a compliment. Tell him time is of the essence. I'm really more
                                            an apartment person. Finding a needle in a haystack isn't hard when every straw is computerized.
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="pills-career" role="tabpanel" aria-labelledby="pills-profile-tab-custom">
                                        <div class="media">
                                            <img class="me-3 w-25 rounded" src="../../../../images/samples/300x300/10.jpg" alt="sample image">
                                            <div class="media-body">
                                                <p>I'm thinking two circus clowns dancing. You? Finding a needle in a haystack isn't hard when every straw is
                                                    computerized. Tell him time is of the essence.
                                                    Somehow, I doubt that. You have a good heart, Dexter.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-music" role="tabpanel" aria-labelledby="pills-contact-tab-custom">
                                        <div class="media">
                                            <img class="me-3 w-25 rounded" src="../../../../images/samples/300x300/14.jpg" alt="sample image">
                                            <div class="media-body">
                                                <p>
                                                    I'm really more an apartment person. This man is a knight in shining armor. Oh I beg to differ,
                                                    I think we have a lot to discuss. After all, you are a client. You all right, Dexter?
                                                </p>
                                                <p>
                                                    I'm generally confused most of the time. Cops, another community I'm not part of. You're a killer.
                                                    I catch killers. Hello, Dexter Morgan.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-vibes" role="tabpanel" aria-labelledby="pills-vibes-tab-custom">
                                        <div class="media">
                                            <img class="me-3 w-25 rounded" src="../../../../images/samples/300x300/15.jpg" alt="sample image">
                                            <div class="media-body">
                                                <p>
                                                    This man is a knight in shining armor. I feel like a jigsaw puzzle missing a piece. And I'm not
                                                    even sure what the picture should be. Somehow, I doubt that. You have a good heart, Dexter. Keep your mind limber.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade active show" id="pills-energy" role="tabpanel" aria-labelledby="pills-energy-tab-custom">
                                        <div class="media">
                                            <img class="me-3 w-25 rounded" src="../../../../images/samples/300x300/11.jpg" alt="sample image">
                                            <div class="media-body">
                                                <p>
                                                    Finding a needle in a haystack isn't hard when every straw is computerized. You're a killer. I catch killers.
                                                    I will not kill my sister. I will not kill my sister. I will not kill my sister. Rorschach would say you have a hard time relating to others.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
