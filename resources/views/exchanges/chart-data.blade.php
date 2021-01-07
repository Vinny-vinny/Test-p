@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @include("layouts.nav")
                    </div>
                    <div class="card-body">
                        <table class="table-bordered table-responsive" id="app-datatable" style="width: 100%">
                            <thead>
                            <tr>
                                <th>date</th>
                                <th>high</th>
                                <th>low</th>
                                <th>open</th>
                                <th>close</th>
                                <th>volume</th>
                                <th>quoteVolume</th>
                                <th>weightedAverage</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="t in exchanges">
                                <td>@{{t.date}}</td>
                                <td>@{{t.high}}</td>
                                <td>@{{t.low}}</td>
                                <td>@{{t.open}}</td>
                                <td>@{{t.close}}</td>
                                <td>@{{t.volume}}</td>
                                <td>@{{t.quoteVolume}}</td>
                                <td>@{{t.weightedAverage}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        const app = new Vue({
            el: "#app",
            data:{
                exchanges:{},
            },
            mounted() {
                this.listen()
                this.getExchanges();
                this.callPhoenixApi();
                this.initDatatable();
            },
            methods:{
                callPhoenixApi(){
                    setInterval(()=>{
                        this.getExchanges();
                    },5000)
                },
                getExchanges(){
                    axios.get("/api/new-chart-data")
                        .then(response => {
                            this.exchanges = response.data;
                            this.reinitDatatable();
                        }).catch(err => {
                        console.log(err)
                    })
                },
                listen(){
                    Echo.channel("chart-data")
                        .listen("ChartData",() => {})
                },
                initDatatable(){
                    setTimeout(()=>{
                        $('#app-datatable').DataTable();
                    },200)
                },
                reinitDatatable(){
                    $('#app-datatable').DataTable().destroy();
                    this.initDatatable();
                }
            }
        })
    </script>
@endsection
