<template>
    <div>
        <!--    Site template    -->
        <b-container>
            <b-row class="py-3">
                <b-col cols="8">
                    <b-jumbotron>
                        <template v-slot:header>Fsre-Code-Learning</template>

                        <template v-slot:lead>
                            Learn how to code fast and effective with us.
                        </template>

                        <hr class="my-4">

                        <b-button variant="primary" href="#">Do Something</b-button>
                        <b-button variant="success" href="#">Do Something Else</b-button>
                    </b-jumbotron>
                </b-col>
            </b-row>

            <b-row class="py-3">
                <b-col cols="4"></b-col>
                <b-col cols="8">
                    <b-tabs content-class="mt-3" fill class="border border-info">
                        <b-tab title="First" active><p>I'm the first tab</p></b-tab>
                        <b-tab title="Second"><p>I'm the second tab</p></b-tab>
                        <b-tab title="Disabled" disabled><p>I'm a disabled tab!</p></b-tab>
                    </b-tabs>
                </b-col>
            </b-row>

            <b-row class="py-3">
                <b-col cols="2"></b-col>
                <b-col cols="8">
                    <b-carousel
                        id="carousel-1"
                        v-model="slide"
                        :interval="4000"
                        controls
                        indicators
                        background="#ababab"
                        img-width="1024"
                        img-height="480"
                        style="text-shadow: 1px 1px 2px #333;"
                        @sliding-start="onSlideStart"
                        @sliding-end="onSlideEnd"
                    >
                        <!-- Text slides with image -->
                        <b-carousel-slide
                            caption="First slide"
                            text="Nulla vitae elit libero, a pharetra augue mollis interdum."
                            img-src="https://picsum.photos/1024/480/?image=52"
                        ></b-carousel-slide>

                        <!-- Slides with custom text -->
                        <b-carousel-slide img-src="https://picsum.photos/1024/480/?image=54">
                            <h1>Hello world!</h1>
                        </b-carousel-slide>

                        <!-- Slides with image only -->
                        <b-carousel-slide img-src="https://picsum.photos/1024/480/?image=58"></b-carousel-slide>

                        <!-- Slides with img slot -->
                        <!-- Note the classes .d-block and .img-fluid to prevent browser default image alignment -->
                        <b-carousel-slide>
                            <template v-slot:img>
                                <img
                                    class="d-block img-fluid w-100"
                                    width="1024"
                                    height="480"
                                    src="https://picsum.photos/1024/480/?image=55"
                                    alt="image slot"
                                >
                            </template>
                        </b-carousel-slide>

                        <!-- Slide with blank fluid image to maintain slide aspect ratio -->
                        <b-carousel-slide caption="Blank Image" img-blank img-alt="Blank image">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eros felis, tincidunt
                                a tincidunt eget, convallis vel est. Ut pellentesque ut lacus vel interdum.
                            </p>
                        </b-carousel-slide>
                    </b-carousel>
                </b-col>
            </b-row>

        </b-container>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
