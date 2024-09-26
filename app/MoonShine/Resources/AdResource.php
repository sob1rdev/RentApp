<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\MoonShine\Pages\Gender;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ad;

use MoonShine\Fields\Enum;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasMany;
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
                Text::make('title')->sortable(),
                Text::make('description')->hideOnIndex(),
                Number::make('price')->sortable(),
                Number::make('rooms')->sortable(),
                Text::make('address')->sortable()->hideOnIndex(),
                Enum::make('gender')->attach(Gender::class)->sortable(),
                BelongsTo::make('users', resource: new UserResource())->sortable(),
                BelongsTo::make('branch', resource: new BranchResource())->sortable(),
                BelongsTo::make('status', resource: new StatusResource())->sortable(),
                HasMany::make('image', relationName: 'image', resource: new ImageResource())->onlyLink(),

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
