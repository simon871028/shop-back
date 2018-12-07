@extends('layouts.blank')
@section('title','訂單列表')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">訂單資訊</h4>
            <div class="row">
                <div class="col-12">
                    <!-- /.box-header -->
                    <div class="box-body" >
                        <table class="table table-bordered">
                            <tr>
                                <th>id</th>
                                <th>姓名</th>
                                <th>公司名稱</th>
                                <th>地址</th>
                                <th>email</th>
                                <th>手機</th>
                                <th>總價</th>
                                <th>配送狀態</th>
                                <th>管理功能</th>
                            </tr>
                            @foreach ($orders as $order)

                                <tr>
                                    <td>{{ $order->id }}.</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->company_name }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->amount }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('order.update', $order->id) }}" method="post" style="display: inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-xs btn-outline-danger">更改狀態</button>
                                        </form>
                                        <form action="{{ route('order.destroy', $order->id) }}" method="post" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-outline-danger">取消</button>
                                        </form>
                                        <a href="{{ route('order.show', $order->id) }}" class="btn btn-xs btn-outline-primary">詳細</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div>
                        {!! $orders->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


