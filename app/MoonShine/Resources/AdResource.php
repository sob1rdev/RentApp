<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\MoonShine\Pages\Gender;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ad;

use MoonShine\Fields\Enum;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Ad>
 */
class AdResource extends ModelResource
{
    protected string $model = Ad::class;

    protected string $title = 'Ads';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('title'),
                Text::make('description'),
                Number::make('price'),
                Number::make('rooms'),
                Text::make('address'),
                Enum::make('gender')->attach(Gender::class)->sortable(),
                Number::make('user_id')->sortable(),
                Number::make('branch_id')->sortable(),
                Number::make('status_id')->sortable(),

            ]),
        ];
    }

    /**
     * @param Ad $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
