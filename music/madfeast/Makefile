MIDI=if-music-be-the-food-of-love.midi

all: soprano alto tenor bass

%: %.cfg $(MIDI)
	timidity -Ow -o $(basename $(MIDI))-$@.wav --verbose -c $@.cfg $(MIDI)
	lame $(basename $(MIDI))-$@.wav $(basename $(MIDI))-$@.mp3

%.midi: %.abc
	abc2midi $*.abc -o $*.midi -RS

clean:
	-rm *.wav *.midi *.mp3
