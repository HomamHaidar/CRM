@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/3.0.24/tailwind.min.css">
    <style>
        .kanban-container {
            display: flex;
            flex-direction: column;
            padding: 10px;
            gap: 20px; /* Add space between boards */
        }
        .kanban-board {
            display: flex;
            overflow-x: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            background: #f9f9f9;
            width: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add shadow */
            flex-direction: column;
            gap: 10px;
        }
        .kanban-board h2 {
            margin-bottom: 20px;
        }
        .kanban-stages {
            display: flex;
            gap: 10px; /* Add space between stages */
            width: 100%;
            overflow-x: auto;
        }
        .kanban-stage {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            background: #f9f9f9;
            flex: 0 0 auto;
            width: 200px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add shadow */
        }
        .kanban-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            background: #fff;

            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add shadow */
        }
    </style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الصفقات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ سجل الصفقات</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
                @can('add deal')
				<div class="row">
                        <a href="{{route('deal.create')}}" class="btn btn-success-gradient btn-with-icon ">
                            <i class="typcn typcn-plus"> اضافة صفقة </i>    </a></div>
                @endcan
                <div class="kanban-container">
                    @foreach ($journeys as $journey)
                        <div class="kanban-board" data-journey-id="{{ $journey->id }}">
                            <h2 class="font-bold text-lg mb-4">{{ $journey->name }}</h2>
                            <div class="kanban-stages">
                                @foreach ($journey->stages as $stage)
                                    <div class="kanban-stage" data-stage-id="{{ $stage->id }}">
                                        <h3 class="font-semibold text-md mb-2">{{ $stage->name }}</h3>
                                        @foreach ($stage->deals as $deal)

                                            <div class="kanban-card" data-deal-id="{{ $deal->id }}">
                                                <a href="{{route('deal.show',$deal->id)}}">
                                                <h4 class="font-bold">{{ $deal->title }}</h4>
                                                <p>{{ $deal->description }}</p>
                                                </a>
                                                <form method="POST" action="{{route('update.stage',$deal->id)}}">
                                                    @csrf
                                                        <input type="hidden" name="next" value="1">
                                                    <button type="submit" class="btn btn-primary-gradient btn-with-icon ">نقل الى المرحلة التالية</button>

                                                </form>
                                                <br>
                                          @if($stage->id!= $journey->stages[0]->id)

                                                <form method="POST" action="{{route('update.stage',$deal->id)}}">
                                                    @csrf
                                                        <input type="hidden" name="perv" value="1">
                                                    <button type="submit" class="btn btn-warning-gradient btn-with-icon ">تراجع الى  المرحلة السابقة</button>

                                                </form>
                                            @endif
                                            </div>

                                            <div>
                                            </div>
                                        @endforeach
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
				<!-- row closed -->

			<!-- Container closed -->
		<!-- main-content closed -->
@endsection
@section('js')

@endsection
