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
                       <table class="table table-bordered table-responsive" id="app-datatable" style="width: 100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>last</th>
                                <th>lowestAsk</th>
                                <th>highestBid</th>
                                <th>percentChange</th>
                                <th>baseVolume</th>
                                <th>quoteVolume</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="t in exchanges">
                                <td>@{{t.id}}</td>
                                <td>@{{t.last}}</td>
                                <td>@{{t.lowestAsk}}</td>
                                <td>@{{t.highestBid}}</td>
                                <td>@{{t.percentChange}}</td>
                                <td>@{{t.baseVolume}}</td>
                                <td>@{{t.quoteVolume}}</td>
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
                  axios.get("/api/new-return-ticker")
                      .then(response => {
                          this.exchanges = response.data;
                          this.reinitDatatable();
                      }).catch(err => {
                      console.log(err)
                  })
              },
              listen(){
                  Echo.channel("crypto-ticker")
                  .listen("ReturnTicker",() => {})
              },
              initDatatable(){
                  setTimeout(()=>{
                      $('#app-datatable').DataTable();
                  },200)
              },
              reinitDatatable(){
                  $('#app-datatable').DataTable().destroy();
                  this.initDatatable();
              },

          }
        })
    </script>
@endsection
