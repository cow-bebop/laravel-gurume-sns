<template>
    <div>
        <button v-on:click="search">検索する</button>
        <input v-model="searchText" type="text" placeholder="検索キーワード" />
        <select name="" id="">
            <option value="PREF13">東京</option>
            <option value="PREF14">神奈川</option>
        </select>
        <div v-for="(rest, key) in restaurants" :key="key">
            <div>
                <img :src="rest.image_url.shop_image1" alt="" />
            </div>
            <p>
                <a :href="rest.url">{{ rest.name }}</a>
            </p>
            <p style="margin-bottom: 20px;">
                {{ rest.address }}
            </p>
            <p>
                {{ rest.budget }}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    data: {
        restaurants: [],
        searchText: ""
    },
    mounted: function() {
        // mountedはレンダリングされた後に呼び出す
        this.search();
    },
    computed: {
        highRank: function() {
            return this.restaurants.filter(rest => _.budget >= 3000);
        }
    },
    methods: {
        search: function() {
            axios
                .get("https://api.gnavi.co.jp/RestSearchAPI/v3/?", {
                    params: {
                        keyid: "64e2ff3d3d78700b866058e740cef888",
                        pref: "PREF13",
                        freeword: this.searchText
                    }
                })
                .then(response => {
                    // methodsではfunction()を基本的に使うが、axiosなどではアロー関数を使わないとvueのthisを指定できないので気をつける
                    // handle success
                    this.restaurants = response.data.rest;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                })
                .then(function() {
                    // always executed
                });
        }
    }
};
</script>
