@extends('layouts.admin')

@section('breadcrumb', 'لوحة التحكم / الرسائل')

@section('content')
    <style>
        .messages-table {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 14px;
            overflow: hidden;
        }

        .messages-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .messages-table thead {
            background: rgba(255, 255, 255, 0.05);
        }

        .messages-table th {
            padding: 16px;
            text-align: right;
            font-weight: 700;
            font-size: 14px;
        }

        .messages-table td {
            padding: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .message-unread {
            background: rgba(63, 163, 255, 0.05);
            font-weight: 600;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-new {
            background: rgba(63, 163, 255, 0.15);
            color: var(--color-primary);
        }

        .badge-read {
            background: rgba(255, 255, 255, 0.1);
            color: var(--color-text-dim);
        }
    </style>

    <div class="page-header"
        style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
        <h1 style="font-size: 28px; font-weight: 800; margin: 0;">
            <i class="fa-solid fa-envelope"></i> رسائل الاتصال
        </h1>
        <div>
            <span
                style="background: rgba(63,163,255,0.15); color: var(--color-primary); padding: 8px 16px; border-radius: 20px; font-weight: 700;">
                <i class="fa-solid fa-envelope-open-text"></i> {{ $contacts->total() }} رسالة
            </span>
        </div>
    </div>

    @if($contacts->count() > 0)
        <div class="messages-table">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الهاتف</th>
                        <th>الرسالة</th>
                        <th style="width: 120px;">التاريخ</th>
                        <th style="width: 100px;">الحالة</th>
                        <th style="width: 100px;">إجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr class="{{ !$contact->is_read ? 'message-unread' : '' }}">
                            <td><strong>#{{ $contact->id }}</strong></td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone ?? '-' }}</td>
                            <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $contact->message }}
                            </td>
                            <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                            <td>
                                @if($contact->is_read)
                                    <span class="badge badge-read">مقروءة</span>
                                @else
                                    <span class="badge badge-new">جديدة</span>
                                @endif
                            </td>
                            <td>
                                @if(!$contact->is_read)
                                    <form method="POST" action="{{ route('admin.contacts.read', $contact->id) }}"
                                        style="display: inline; margin: 0;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn--outline" style="padding: 6px 12px; font-size: 13px;">
                                            <i class="fa-solid fa-check"></i> قراءة
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 24px;">
            {{ $contacts->links() }}
        </div>
    @else
        <div style="padding: 60px 20px; text-align: center; background: rgba(255,255,255,0.03); border-radius: 14px;">
            <i class="fa-solid fa-inbox" style="font-size: 48px; color: var(--color-text-dim); margin-bottom: 16px;"></i>
            <h3>لا توجد رسائل</h3>
            <p style="color: var(--color-text-dim);">لم يتم استلام أي رسائل بعد</p>
        </div>
    @endif
@endsection