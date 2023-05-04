<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ReplyComment;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::now()->format('Y-m-d');
        $orders = Order::when($request->date != null, function ($e) use ($request) {
            return $e->whereDate('created_at', $request->date);
        })
            ->when($request->status != null, function ($e) use ($request) {
                return $e->where('status_message', $request->status);
            })
            ->when($request->date == '' && $request->status == null, function ($e) {
                return $e;
            })
            ->paginate(10)->withQueryString();
        return view('admin.order.index', compact('orders'));
    }
    public function view($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        return view('admin.order.view', compact('order'));
    }

    public function updateStatusMessage(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status_message' => 'required|string'
        ]);
        $order = Order::find($id);
        $order->status_message = $validatedData['status_message'];
        $order->save();

        return redirect()->back()->with('message', 'Order Changed Successfully');
    }

    public function replyComment(Request $request,$id)
    {
        $replyComment = new ReplyComment();
        $replyComment->comment_id = $id;
        $replyComment->reply_user_id = $request->reply_user_id;
        $replyComment->comment = $request->comment;
        $replyComment->save();
        return redirect()->back()->with('message', 'Comment Create Successfully');
    }

    public function viewInvoice($order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('admin.invoice.generate-invoice', compact('order'));
    }
    public function generateInvoice($order_id)
    {
        $order = Order::findOrFail($order_id);
        $data = ['order' => $order];
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'.pdf');
    }
}
