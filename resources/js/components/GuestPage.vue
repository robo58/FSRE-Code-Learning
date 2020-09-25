<template>
    <b-container class="py-3">

        <!--  Header of the page  -->
        <b-row class="py-3 bg-primary rounded">
            <b-col>
                <b-jumbotron
                    header="Fsre Code Learning"
                    lead="Learn to code with us."
                    bg-variant="primary"
                    text-variant="white"
                >
                    <div class="px-2" v-if="user===null">
                        <b-button variant="light" href="/register">Create an account</b-button><br>
                        <a class="text-white text-decoration-underline" href="/login">Already have an account?</a>
                        <h5 style="float:right">Volite programiranje ? Nikada se niste susreli, <br>ali zanima vas što je to ? Pridružite se Robertu i meni, <br>započnite jedan od naših brojnih tečajeva <br> i upustite se u novu avanturu. </h5>
                    </div>
                    <div v-else>
                        <p>Welcome {{ user.name }}.</p>
                    </div>
                </b-jumbotron>
            </b-col>
        </b-row>

        <!--  Author info  -->
        <b-row class="my-3 bg-info rounded">
            <b-col sm="2"></b-col>
            <b-col sm="4" class="py-3">
                <b-card
                    tag="article"
                    style="max-width: 20rem; max-height: 30rem; min-height: 30rem;"
                    class="mb-2"
                >
                    <div class="d-flex justify-content-center">
                        <b-card-img top src="uploads/avatars/IMG_20200802_182041.jpg" style="width:50%; height:50%; border-radius:50%; margin-right:25px;"></b-card-img>
                    </div>
                    <b-card-title class="py-3">Robert Sliskovic</b-card-title>
                    <b-card-text>
                        <ul>
                            <li>
                                Full stack developer,
                            </li>
                            <li>
                                Vue.js, Laravel, Bootstrap-vue, MySql,
                            </li>
                            <li>
                                Student na FSRE u Mostaru,
                            </li>
                            <li>
                                Sports, Gym and Gaming lover.
                            </li>
                        </ul>
                    </b-card-text>
                    <div class="d-flex justify-content-center">
                        <b-button-group>
                            <b-button size="lg" variant="secondary" href="https://github.com/robo58" target="_blank"><i class='fa fa-github'></i></b-button>
                            <b-button size="lg" variant="primary" href="https://www.facebook.com/robertsliskovic/" target="_blank"><i class="fa fa-facebook"></i></b-button>
                            <b-button size="lg" style="background-color: mediumpurple"><i class="fa fa-instagram" href="#" target="_blank"></i></b-button>
                        </b-button-group>
                    </div>
                </b-card>
            </b-col>

            <b-col sm="4" class="py-3">
                <b-card
                    tag="article"
                    style="max-width: 20rem; max-height: 30rem; min-height: 30rem;"
                    class="mb-2"
                >
                    <div class="d-flex justify-content-center">
                        <b-card-img top src="uploads/avatars/default.jpg" style="width:50%; height:50%; border-radius:50%; margin-right:25px;"></b-card-img>
                    </div>
                    <b-card-title class="py-3">Branimir Raguz</b-card-title>
                    <b-card-text>
                        <ul>
                            <li>
                                Full stack developer,
                            </li>
                            <li>
                                Vue.js, Laravel, Bootstrap-vue, MySql,
                            </li>
                            <li>
                                Student na FSRE u Mostaru,
                            </li>
                            <li>
                                Sports, Gym and Gaming lover.
                            </li>
                        </ul>
                    </b-card-text>
                    <div class="d-flex justify-content-center">
                        <b-button-group>
                            <b-button size="lg" variant="secondary" href="https://github.com/breezy11" target="_blank"><i class='fa fa-github'></i></b-button>
                            <b-button size="lg" variant="primary" href="https://www.facebook.com/robertsliskovic/" target="_blank"><i class="fa fa-facebook"></i></b-button>
                            <b-button size="lg" style="background-color: mediumpurple"><i class="fa fa-instagram" href="#" target="_blank"></i></b-button>
                        </b-button-group>
                    </div>
                </b-card>
            </b-col>
        </b-row>

        <!--  Contact form  -->
        <form action="/" method="POST">
        <b-row class="my-3 bg-primary rounded justify-content-center">
            <b-col>
                <div class="my-3 text-white">
                    <b-card-title class="text-center">Contact us</b-card-title>
                    <b-form-group
                        label-cols-sm="1"
                        label="Name:"
                        label-align-sm="right"
                        label-for="contact-name"
                    >
                        <b-form-input id="contact-name"></b-form-input>
                    </b-form-group>

                    <b-form-group
                        label-cols-sm="1"
                        label="Email:"
                        label-align-sm="right"
                        label-for="contact-email"
                    >
                        <b-form-input id="contact-email"></b-form-input>
                    </b-form-group>

                    <b-form-group
                        label-cols-sm="1"
                        label="Message:"
                        label-align-sm="right"
                        label-for="contact-message"
                    >
                        <b-form-textarea id="contact-message"></b-form-textarea>
                    </b-form-group>
                    <div class="d-flex justify-content-center">
                        <b-button type="submit" variant="secondary">Submit</b-button>
                    </div>
                </div>
            </b-col>
        </b-row>
        </form>

    </b-container>
</template>

<script>
    export default{
        props:{
            user:{
                default: null,
                type: Object
            }
        }
    }
</script>
