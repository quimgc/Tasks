<template>

    <timeline :events="taskEvents"></timeline>
    <div class="timeline">

        <div class="timeline-event" v-for="event in taskEvents">


            <div class="timeline-content">

                <v-card>
                    <!--<v-card-media src="/static/doc-images/cards/desert.jpg" height="200px">-->
                    <!--</v-card-media>-->
                    <v-card-title primary-title>
                        <div>
                            <h3 class="headline mb-0">Event 1</h3>
                            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto asperiores assumenda eligendi laboriosam totam. Dolorem, dolorum eaque. Blanditiis culpa dicta excepturi explicabo inventore magni nam numquam, quisquam saepe sed vitae?</div>
                        </div>
                    </v-card-title>
                    <v-card-actions>
                        <v-btn flat color="orange">Share</v-btn>
                        <v-btn flat color="orange">Explore</v-btn>
                    </v-card-actions>
                </v-card>

            </div>

            <div class="timeline-badge blue white-text">

                <v-icon>more</v-icon>

            </div>
        </div>


    </div>
</template>

<style>

    .timeline {

        position: relative;
        /*border: 1px solid black;*/
        /*margin: 40px;*/


    }

    .timeline .timeline-event {

        position: relative;
        padding-top: 5px;
        padding-bottom: 5px;

    }



    .timeline .timeline-badge {

        display: block;
        position: absolute;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        /*background-color: #d2d2d2;*/
        text-align: center;
        top: calc(50% - 20px);
        left: calc(50%);
        cursor: default;
        /*right: calc(50% - 1px);*/

    }
    .timeline .timeline-event .timeline-content {

        /*border: 1px solid blue;*/
        position: relative;
        left: 70px;
    }

    .timeline .timeline-event:before {

        display: block;
        position: absolute;
        content: "";
        width: 2px;
        height: calc(50% - 25px);
        background-color: #d2d2d2;
        top: 0;
        left: calc(50% + 20px);

    }

    .timeline .timeline-event:after {

        display: block;
        position: absolute;
        content: "";
        width: 2px;
        height: calc(50% - 25px);
        background-color: #d2d2d2;
        top: calc(50% + 25px);
        left: calc(50% + 20px);

    }


    .timeline .timeline-badge i {

        line-height: 40px;
    }

    .timeline .timeline-event:last-child::after{

        display: none;
    }
    .timeline .timeline-event:last-child::before{

        /*display: none;*/
    }

    .timeline .timeline-event .timeline-content {
        width: calc(50% - 80px);

    }

    .timeline .timeline-event:nth-child(even) .timeline-content{

        /*right: 50%;*/

    }


    .timeline .timeline-event:nth-child(odd) .timeline-content{

        left: calc(50% + 55px);
    }


    @media(max-width: 600px){

        .timeline .timeline-event::before {

            left: 15px;

        }

        .timeline .timeline-event::after {

            left: 15px;

        }


        .timeline .timeline-badge {

            left: -5px;
        }

        .timeline .timeline-event:nth-child(even) .timeline-content{

            left: 50px;
            width: calc(100% - 35px);


        }


        .timeline .timeline-event:nth-child(odd) .timeline-content{

            left: 50px;
            width: calc(100% - 35px);

        }
    }


</style>

<script>
  import Timeline from './TimelineComponent.vue'

  export default {

    name: 'TasksTimeline',
    components: { Timeline },
    data () {
      return {
        taskEvents: []
      }
    },
    mounted () {
      this.taskEvents = [
        {
          'time': '',
          'type': 'created',
          'task_name': 'taskName',
          'task_user': 'taskUser'
        }
      ]
    }
}
</script>