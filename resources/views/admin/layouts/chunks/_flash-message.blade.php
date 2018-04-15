@if (FlashMessage::hasMessage())
    <div id="flash-message" class="message message--{{ FlashMessage::getLevel() }}">
            <strong>{{ strtoupper(FlashMessage::getLevel()) }}:</strong>
            {{ FlashMessage::getMessage() }}
    </div>
@endif
