@extends('user.layout')

<style>
    #spin-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .spin-to-win {
        max-width: 600px;
    }

    .spin-to-win img {
        width: 100%;
        height: auto;
    }

    #spinner {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        vertical-align: middle;
    }

    #spin-btn {
        cursor: pointer;
        background: white;
        /*   background-image:url('https://contentservice.mc.reyrey.net/image_v1.0.0/?id=d08f9524-26eb-53be-a6a1-bc8d8e19cc20&637070095483683129'); */
        background-size: 100% 100%;
        box-shadow: 0 0 15px rgba(0, 0, 0, .25);
        animation: spinBtn 2s linear infinite;
        border: 5px solid transparent;
        text-align: center;
    }

    #spin-btn p {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        margin: 0;
        font-family: 'Montserrat', sans-serif;
    }

    @keyframes spinBtn {
        0% {
            border: 5px solid black;
        }

        50% {
            border: 5px solid red;
        }

        100% {
            border: 5px solid black;
        }
    }

    #spin-btn,
    #spin-arrow {
        max-width: 180px;
        width: calc(100vw * .3);
        max-height: 180px;
        height: calc(100vw * .3);
        border-radius: 50%;
        display: inline-block;
        position: absolute;
    }

    #spin-arrow {
        transition-timing-function: ease-in-out;
        transition: 3s;
        /* animation: spin 300ms linear infinite; */
    }

    #spin-arrow:after {
        content: '';
        position: absolute;
        left: 2px;
        top: 2px;
        width: calc(100vw * .14167);
        max-width: 85px;
        height: calc(100vw * .14167);
        max-height: 85px;
        background-color: white;
        box-shadow: -2px -2px 10px rgba(0, 0, 0, .25);
    }

    /* btn styles */
    #si-btn {
        max-width: 320px;
        background: white;
        color: black;
        text-align: center;
        font-family: sans-serif;
        border-radius: 15px;
        margin: 0 auto 25px auto;
        padding: 0px;
        /*   transition:2s; */
        filter: invert(1);
        opacity: 0;
    }

    /* #si-btn:hover {
  background:#e81238;
} */
    #si-btn a {
        color: inherit;
        text-decoration: none;
        display: inline-block;
        padding: 20px 35px;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

@section('header')
    <ion-title>Grab and Earn</ion-title>
    <ion-button slot="start" href="/user/dashboard">
        <ion-icon name="arrow-back-outline"></ion-icon>
    </ion-button>
@endsection

@section('content')
    <ion-card>
        <ion-card-header>
            <ion-title class="text-center">Grab Your Order</ion-title>
            <p class="text-center">click on grab your order button and wait.</button></p>
        </ion-card-header>
        <div id="spin-container">
            <div id="spinner" class="spin-to-win">
                <img
                    src="https://contentservice.mc.reyrey.net/image_v1.0.0/?id=e61fefdc-85d3-5145-9b3a-821b2ad47040&637115173847423178" />
                <div id="spin-arrow"></div>
                <div id="spin-btn">
                    <p>Grab Your Order
                    <p>
                </div>
            </div>
        </div>
    </ion-card>

    <ion-card class="ion-padding">
        <ion-grid>
            <ion-row>
                <ion-col>
                    <ion-label>Available Orders</ion-label>
                </ion-col>
                <ion-col>
                    <ion-text><strong>28\28</strong></ion-text>
                </ion-col>
            </ion-row>
            <ion-row>
                <ion-col>
                    <ion-label>Current Package</ion-label>
                </ion-col>
                <ion-col>
                    <ion-text><strong>VIP 1</strong></ion-text>
                </ion-col>
            </ion-row>
            <ion-row>
                <ion-col>
                    <ion-label>Username</ion-label>
                </ion-col>
                <ion-col>
                    <ion-text><strong>{{Auth::user()->username}}</strong></ion-text>
                </ion-col>
            </ion-row>
        </ion-grid>
    </ion-card>

    <ion-modal initial-breakpoint="0.75" mode="ios">
        <ion-header>
            <ion-toolbar>
                <ion-title>Order</ion-title>
                <ion-buttons slot="end">
                    <ion-button onclick="modal.dismiss()">Close</ion-button>
                </ion-buttons>
            </ion-toolbar>
        </ion-header>
        <ion-content class="ion-padding">
            <ion-image>
                <img alt="" id="image" referrerpolicy="no-referrer">
            </ion-image>
            <ion-item>
                <ion-label id="title"></ion-label>
            </ion-item>
            <ion-item>
                <ion-label id="price"></ion-label>
            </ion-item>
            <ion-item>
                <ion-label>Order Number: #123456</ion-label>
            </ion-item>
            
            <div style="height: 50px;" >
                <ion-button expand="block">
                <ion-icon name="cart-outline" slot="start"></ion-icon>
                Claim Order
            </div>
            </ion-item>
        </ion-content>
    </ion-modal>
@endsection

@section('script')
    <script>
        var spinBtn = document.querySelector('#spin-btn')
        var spinArrow = document.querySelector('#spin-arrow')
        const modal = document.querySelector('ion-modal');
        const image = document.querySelector('#image');
        const title = document.querySelector('#title');
        const price = document.querySelector('#price');


        spinBtn.addEventListener('click', function() {
            spinArrow.style.animation = 'spin 300ms linear infinite';

            setTimeout(() => {
                //  random number between 0 and 81
                var num = Math.floor(Math.random() * 20) + 1;
                $.ajax({
                    type: "get",
                    url: "https://api.escuelajs.co/api/v1/products/" + num,
                    success: function(response) {
                        console.log(response);
                        // handle response here


                        image.src = response.images[0]
                        title.textContent = response.title;
                        price.textContent = 'Price: $' + response.price;

                        spinArrow.style.animationPlayState = 'paused';
                        modal.present();
                    }
                });
            }, 3000);
        })
    </script>
@endsection
