<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <br>
                <h4> xfx</h4>

                <ul class="list-group">
                        <a v-for="item in polling" :key="item.id" href="#" data-lat="{{}}" data-lng="{{}}" >
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{'looolll'}}
                            <span class="badge badge-primary badge-pill">{{' CDF'}}</span>
                            </li>
                        </a>    
                </ul>
                
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props:['userId'],
        
       data () {
            return {
                polling: null
            }
        },
        methods: {
            pollData () {
                this.polling = setInterval(() => {
                    axios.get('http://localhost:8000/api/user/planning/' + this.userId)
                    .then( (response)=> {
                        this.polling = response.data
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }, 3000)
            }
        },
        created () {
            this.pollData()
        }
    }
</script>
