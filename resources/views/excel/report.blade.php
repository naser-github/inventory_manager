<table>
    <thead>
    <tr>
        <th rowspan="2">ক্রমিক নং</th>
        <th rowspan="2">বিবরণী</th>
        <th colspan="8">মজুদ মালের পরিমান</th>
        <th rowspan="2">টাকা</th>
    </tr>
    <tr>
        <th>প্রারম্ভিক</th>
        <th>দর</th>
        <th>টাকা</th>
        <th>ক্রয়</th>
        <th>দর</th>
        <th>বিক্রয়</th>
        <th colspan="2">সমাপনী</th>
    </tr>
    </thead>
    <tbody>
    @foreach($stock_report_data as $key=>$item)
        <tr>
            <td>
                {{$key+1}}
            </td>
            <td>
                {{$item['item_name']}}
            </td>
            <td>
                {{round($item['opening_quantity'],2)}}
            </td>
            <td>
                {{
                    round($item['opening_unit_price'],2)
                }}
            </td>
            <td>
                {{
                    round($item['opening_quantity']*$item['opening_unit_price'],2)
                }}
            </td>
            <td>
                {{
                    round($item['inbound_quantity'],2)
                }}
            </td>
            <td>
                {{
                    round($item['inbound_unit_price'],2)
                }}
            </td>
            <td>
                {{
                    round($item['consumption_quantity'],2)
                }}
            </td>
            <td>
                {{
                    round($item['opening_quantity'] + $item['inbound_quantity'] - $item['consumption_quantity'],2)
                }}
            </td>
            <td>
                {{$item['item_unit']}}
            </td>
            <td>
                @if(($item['opening_quantity']*$item['opening_unit_price']+$item['inbound_quantity']*$item['inbound_unit_price'])>0)
                    {{
                        round(
                            ($item['opening_quantity']*$item['opening_unit_price']+$item['inbound_quantity']*$item['inbound_unit_price'])
                            -
                            (
                                (
                                    (
                                        $item['opening_quantity']*$item['opening_unit_price']
                                        +
                                        $item['inbound_quantity']*$item['inbound_unit_price']
                                    )
                                    /
                                    ($item['opening_quantity']+$item['inbound_quantity'])
                                )
                                *
                                $item ['consumption_quantity']
                            )
                        ,2)
                    }}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>