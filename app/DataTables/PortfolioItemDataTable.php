<?php

namespace App\DataTables;

use App\Models\PortfolioItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PortfolioItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<PortfolioItem> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('image', function($query){
                return '<img style="width:70px" src="'. asset($query->image).'"></img>';
            })
            ->addColumn('created_at', function($query){
                return date('Y-m-d', strtotime($query->created_at));
            })
            ->addColumn('category', function($query){
                return $query->category->name;                // varbūt $query->category->name;
            })
            ->addColumn('action', function($query){
                return '<a href="'.route('admin.portfolio-item.edit', $query->id).'" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                <a href="'.route('admin.portfolio-item.destroy', $query->id).'" class="btn btn-danger delete-item"><i class="fas fa-trash"></i></a>';
            })
            ->rawColumns(['image', 'action']) // for correct showing image (or btns) in table, not just print as text
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<PortfolioItem>
     */
    public function query(PortfolioItem $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('portfolioItem-table')  //vai pareizi uzrakstīts???
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        // Button::make('excel'),
                        // Button::make('csv'),
                        // Button::make('pdf'),
                        // Button::make('print'),
                        // Button::make('reset'),
                        // Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->width(20),
            Column::make('image')->width(100),
            Column::make('title'),
            Column::make('category'),
            Column::make('created_at'),
   
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(160)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PortfolioItem_' . date('YmdHis');
    }
}
