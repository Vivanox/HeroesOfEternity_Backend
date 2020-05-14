@extends('layouts.app')

@section('content')
    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            User
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            User Agent
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            IP Address
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Keys
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($alphaSignUps as $index => $alphaSignUp)
                        <tr class="{{ $index % 2 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                {{ optional($alphaSignUp->user)->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                {{ $alphaSignUp->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                {{ $alphaSignUp->user_agent }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                {{ $alphaSignUp->ip_address }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                <ul>
                                    @foreach($alphaSignUp->alphaKeys as $alphaKey)
                                        <li>{{ $alphaKey->key }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                <a href="{{ route('alpha-sign-up.assign-alpha-key', $alphaSignUp) }}"
                                   class="text-indigo-600 hover:text-indigo-900"
                                   onclick="event.preventDefault();
                                       confirm('Confirm assigning an alpha key to {{ $alphaSignUp->email }}') && document.getElementById('assign-alpha-key-form__{{ $alphaSignUp->id }}').submit();
                                       ">Assign Alpha Key</a>
                                <form id="assign-alpha-key-form__{{ $alphaSignUp->id }}"
                                      action="{{ route('alpha-sign-up.assign-alpha-key', $alphaSignUp) }}" method="POST"
                                      class="hidden">
                                    {{ csrf_field() }}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    {!! $alphaSignUps->links() !!}
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
