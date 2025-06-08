@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold text-center mb-8">Bagaimana Perasaan Anda Hari Ini?</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <button class="mood-btn p-4 rounded-lg border-2 border-gray-200 hover:border-indigo-500 transition-colors" 
                    data-mood="happy">
                <div class="text-4xl mb-2">😊</div>
                <div class="font-semibold">Senang</div>
            </button>
            <button class="mood-btn p-4 rounded-lg border-2 border-gray-200 hover:border-indigo-500 transition-colors" 
                    data-mood="sad">
                <div class="text-4xl mb-2">😢</div>
                <div class="font-semibold">Sedih</div>
            </button>
            <button class="mood-btn p-4 rounded-lg border-2 border-gray-200 hover:border-indigo-500 transition-colors" 
                    data-mood="energetic">
                <div class="text-4xl mb-2">⚡</div>
                <div class="font-semibold">Energik</div>
            </button>
            <button class="mood-btn p-4 rounded-lg border-2 border-gray-200 hover:border-indigo-500 transition-colors" 
                    data-mood="stressed">
                <div class="text-4xl mb-2">😰</div>
                <div class="font-semibold">Stress</div>
            </button>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg mb-6">
            <h3 class="text-lg font-semibold mb-4">Preferensi Tambahan:</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Strategi Rekomendasi:</label>
                    <select id="strategy" class="w-full p-2 border border-gray-300 rounded-md">
                        <option value="mood">Berdasarkan Mood</option>
                        <option value="health">Fokus Kesehatan</option>
                        <option value="budget">Fokus Budget</option>
                    </select>
                </div>
                
                <div class="flex space-x-4">
                    <label class="flex items-center">
                        <input type="checkbox" id="health_conscious" class="mr-2">
                        <span>Pilihan Sehat</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" id="budget_conscious" class="mr-2">
                        <span>Budget Hemat</span>
                    </label>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Budget Maksimal:</label>
                    <input type="number" id="max_price" placeholder="50000" class="w-full p-2 border border-gray-300 rounded-md">
                </div>
            </div>
        </div>

        <div id="loading" class="hidden text-center py-8">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
            <p class="mt-2">Mencari rekomendasi untuk Anda...</p>
        </div>

        <div id="recommendations" class="hidden">
            <h3 class="text-2xl font-bold mb-6">Rekomendasi Untuk Anda:</h3>
            <div id="recommendations-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Recommendations will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.mood-btn').click(function() {
        const mood = $(this).data('mood');
        const strategy = $('#strategy').val();
        const preferences = {
            health_conscious: $('#health_conscious').is(':checked'),
            budget_conscious: $('#budget_conscious').is(':checked'),
            max_price: $('#max_price').val() || 50000,
            calorie_limit: 400
        };

        // Show loading
        $('#loading').removeClass('hidden');
        $('#recommendations').addClass('hidden');

        // AJAX call to get recommendations
        $.ajax({
            url: '{{ route("mood.detect") }}',
            method: 'POST',
            data: {
                mood: mood,
                strategy: strategy,
                preferences: preferences,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                displayRecommendations(response);
                $('#loading').addClass('hidden');
                $('#recommendations').removeClass('hidden');
            },
            error: function() {
                alert('Terjadi kesalahan. Silakan coba lagi.');
                $('#loading').addClass('hidden');
            }
        });
    });

    function displayRecommendations(response) {
        let html = '';
        response.recommendations.forEach(function(item) {
            let badges = '';
            
            if (item.is_primary) {
                badges += '<span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">⭐ ' + item.primary_tag + '</span>';
            }
            if (item.is_low_calorie) {
                badges += '<span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded ml-2">🥗 ' + item.calorie_tag + '</span>';
            }
            if (item.is_budget_friendly) {
                badges += '<span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded ml-2">💰 ' + item.budget_tag + '</span>';
            }
            if (item.is_spicy) {
                badges += '<span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded ml-2">' + item.spicy_tag + '</span>';
            }

            html += `
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold mb-2">${item.name}</h4>
                        <p class="text-gray-600 mb-4">${item.description}</p>
                        
                        <div class="mb-4">
                            ${badges}
                        </div>
                        
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-lg font-bold text-indigo-600">Rp ${new Intl.NumberFormat('id-ID').format(item.price)}</span>
                            <span class="text-sm text-gray-500">${item.calories} kal</span>
                        </div>
                        
                        <div class="text-sm text-gray-500 mb-4">
                            <span>⏱️ ${item.preparation_time} menit</span>
                            <span class="ml-4">🔥 Level ${item.spicy_level}/5</span>
                        </div>
                        
                        ${item.gofood_link ? 
                            `<a href="${item.gofood_link}" target="_blank" class="block w-full bg-indigo-600 text-white text-center py-2 rounded-md hover:bg-indigo-700 transition-colors">
                                Pesan di GoFood
                            </a>` : ''
                        }
                    </div>
                </div>
            `;
        });

        $('#recommendations-list').html(html);
        
        if (response.metadata) {
            let metaInfo = '<div class="bg-gray-100 p-4 rounded-lg mb-6"><h4 class="font-semibold mb-2">Info Rekomendasi:</h4>';
            if (response.metadata.low_calorie_count) {
                metaInfo += `<p>• ${response.metadata.low_calorie_count} pilihan rendah kalori</p>`;
            }
            if (response.metadata.budget_friendly_count) {
                metaInfo += `<p>• ${response.metadata.budget_friendly_count} pilihan hemat budget</p>`;
            }
            if (response.metadata.spicy_count) {
                metaInfo += `<p>• ${response.metadata.spicy_count} pilihan pedas</p>`;
            }
            metaInfo += '</div>';
            
            $('#recommendations-list').prepend(metaInfo);
        }
    }
});
</script>
@endsection
