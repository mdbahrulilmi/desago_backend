<style>
.btn-danger {
    background-color: #fb0301;
    border-color: #dc3545;  
    color: #ffffff;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 5px;
    display: inline-block;
}
</style>

@props([
    'url',
    'color' => 'danger',
    'align' => 'center',
])
<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<a href="{{ $url }}" class="button btn-danger" target="_blank" rel="noopener">{{ $slot }}</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
