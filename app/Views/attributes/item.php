<?php
/**
 * @var array $definition_names
 * @var array $definition_values
 * @var int $item_id
 * @var array $config
 */
?>


<?php foreach ($definition_values as $definition_id => $definition_value) { ?>

    <div class="form-group form-group-sm">
        <?= form_label($definition_value['definition_name'], $definition_value['definition_name'], ['class' => 'control-label col-xs-3']) ?>
        <div class="col-xs-8">
            <div class="input-group">
                <?php
                echo form_hidden("attribute_ids[$definition_id]", strval($definition_value['attribute_id']));
                $attribute_value = $definition_value['attribute_value'];

                switch ($definition_value['definition_type']) {
                    case DATE:
                        $value = (empty($attribute_value) || empty($attribute_value->attribute_date)) ? NOW : strtotime($attribute_value->attribute_date);
                        echo form_input([
                            'name'               => "attribute_links[$definition_id]",
                            'value'              => to_date($value),
                            'class'              => 'form-control input-sm datetime',
                            'data-definition-id' => $definition_id,
                            'readonly'           => 'true'
                        ]);
                        break;
                    case DROPDOWN:
                        $selected_value = $definition_value['selected_value'];
                        echo form_dropdown([
                            'name'               => "attribute_links[$definition_id]",
                            'options'            => $definition_value['values'],
                            'selected'           => $selected_value,
                            'class'              => 'form-control',
                            'data-definition-id' => $definition_id
                        ]);
                        break;
                    case TEXT:
                        $value = (empty($attribute_value) || empty($attribute_value->attribute_value)) ? $definition_value['selected_value'] : $attribute_value->attribute_value;
                        echo form_input([
                            'name'               => "attribute_links[$definition_id]",
                            'value'              => $value,
                            'class'              => 'form-control valid_chars',
                            'data-definition-id' => $definition_id
                        ]);
                        break;
                    case DECIMAL:
                        $value = (empty($attribute_value) || empty($attribute_value->attribute_decimal)) ? $definition_value['selected_value'] : $attribute_value->attribute_decimal;
                        echo form_input([
                            'name'               => "attribute_links[$definition_id]",
                            'value'              => to_decimals((float)$value),
                            'class'              => 'form-control valid_chars',
                            'data-definition-id' => $definition_id
                        ]);
                        break;
                    case CHECKBOX:
                        $value = (empty($attribute_value) || empty($attribute_value->attribute_value)) ? $definition_value['selected_value'] : $attribute_value->attribute_value;

                        // Sends 0 if the box is unchecked instead of not sending anything.
                        echo form_input([
                            'type'               => 'hidden',
                            'name'               => "attribute_links[$definition_id]",
                            'id'                 => "attribute_links[$definition_id]",
                            'value'              => 0,
                            'data-definition-id' => $definition_id
                        ]);
                        echo form_checkbox([
                            'name'               => "attribute_links[$definition_id]",
                            'id'                 => "attribute_links[$definition_id]",
                            'value'              => 1,
                            'checked'            => $value == 1,
                            'class'              => 'checkbox-inline',
                            'data-definition-id' => $definition_id
                        ]);
                        break;
                }
                ?>
                </span>
            </div>
        </div>
    </div>

<?php } ?>

<script type="text/javascript">
    (function() {
        <?= view('partial/datepicker_locale', ['config' => '{ minView: 2, format: "' . dateformat_bootstrap($config['dateformat'] . '"}')]) ?>


        $("input[name*='attribute_links']").change(function() {
            var definition_id = $(this).data('definition-id');
            $("input[name='attribute_ids[" + definition_id + "]']").val('');
        }).autocomplete({
            source: function(request, response) {
                $.get('<?= 'attributes/suggestAttribute/' ?>' + this.element.data('definition-id') + '?term=' + request.term, function(data) {
                    return response(data);
                }, 'json');
            },
            appendTo: '.modal-content',
            select: function(event, ui) {
                event.preventDefault();
                $(this).val(ui.item.label);
            },
            delay: 10
        });

    })();
</script>
