
<div id="app" class="container">
    <!-- 搜尋框 -->
    <div class="row">
        <div class="col google-map">
            <h5>
                Search：
                <button id='echo8'>取得現在地</button>
            </h5>
            <div class="form-group">
                <input type="text" class="form-control" ref="site" v-model="site">
        
            </div>
        </div>
    </div>
    <!-- 放google map的div -->
    <div class="row">
        <div class="col google-map">
                <h5>Google Map：</h5>
            <div id="map" class="embed-responsive embed-responsive-16by9"></div>
        </div>
    </div>
    <hr>
    <!-- 放評論摘要的div -->
    <div class="row" v-if="place != null">
        <div class="col" v-if="place.reviews != null">
            <h5>評論：</h5>
            <div class="row" v-for="p in place.reviews">
                <div class="col">
                    <ul class="list-unstyled">
                        <li class="media">
                            <img :src="p.profile_photo_url" class="mr-3">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">
                                    <a target="_blank" :href="p.author_url">{{ p.author_name }}</a>
                                </h5>
                                <p>{{ p.text }}</p>
                                <h6>{{ p.relative_time_description }}</h6>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
