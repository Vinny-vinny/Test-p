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
                                <th>#</th>
                                <th>tradeID</th>
                                <th>date</th>
                                <th>type</th>
                                <th>rate</th>
                                <th>amount</th>
                                <th>total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="t in exchanges">
                                <td>@{{t.globalTradeID}}</td>
                                <td>@{{t.tradeID}}</td>
                                <td>@{{t.date}}</td>
                                <td>@{{t.type}}</td>
                                <td>@{{t.rate}}</td>
                                <td>@{{t.amount}}</td>
                                <td>@{{t.total}}</td>
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
                exchanges:{}
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
                    axios.get("/api/new-trade-history")
                        .then(response => {
                            this.exchanges = response.data;
                            this.reinitDatatable();
                        }).catch(err => {
                        console.log(err)
                    })
                },
                listen(){
                    Echo.channel("trade-history")
                        .listen("TradeHistory",() => {})
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
