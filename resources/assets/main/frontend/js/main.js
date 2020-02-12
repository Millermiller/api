import Vue from 'vue'
import VueAwesomeSwiper from 'vue-awesome-swiper';
import 'swiper/dist/css/swiper.css'
import RadialProgressBar from 'vue-radial-progress'
import VueDragDrop from 'vue-drag-drop';
import {cards} from "./content/cards";
import {syns} from "./content/syns";
import {text} from "./content/text";

window.onload = function (e) {
    Array.prototype.remove = function (value) {
        let idx = this.indexOf(value);
        if (idx !== -1) {
            return this.splice(idx, 1);
        }
        return false;
    };

    Array.prototype.shuffle = function () {
        let i = this.length, j, tmp;
        if (i === 0) {
            return this;
        }
        while (--i) {
            j = Math.floor(Math.random() * (i + 1));
            tmp = this[i];
            this[i] = this[j];
            this[j] = tmp;
        }
        return this;
    };

    Vue.use(VueAwesomeSwiper)
    Vue.use(RadialProgressBar)
    Vue.use(VueDragDrop);
    new Vue({
        el: '#slider_view',
        components: {
            LocalSwiper: VueAwesomeSwiper.swiper,
            LocalSlide: VueAwesomeSwiper.swiperSlide,
        },
        data: {
            activeClass: 'ion-ios-star',
            defaultClass: 'ion-ios-star-outline',
            cards: [],
            swiperOptionA: {
                pagination: {
                    el: '.swiper-pagination'
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                },
                spaceBetween: 30,
                centeredSlides: true,
                slidesPerView: 1.5,
                loop: false
            }
        },
        computed: {
            swiperA() {
                return this.$refs.awesomeSwiperA.swiper
            },
        },
        methods: {
            onSetTranslate() {
                console.log('onSetTranslate')
            },
            showTranslate(index) {
                this.cards[index].show = !this.cards[index].show
            },
            play(index) {
                //this.$refs[index].play()
                $('#' + index).trigger("play");
            },
            favourite(index) {
                this.cards[index].favourite = !this.cards[index].favourite
            }
        },
        created: function () {
            this.cards = cards
            this.cards.shuffle()
        }
    })

    new Vue({
        el: '#test_view',
        components: {
            RadialProgressBar
        },
        data: {
            title: '',
            cards: [],
            translates: [], // массив всех translates
            quantity: 0,    // количество вопросов
            question: {},   // текущий вопрос
            variants: [],   // 4 варианта ответа на текущий вопрос
            answers: 0,     // количество данных ответов
            success: 0,     // количество правильных ответов
            percent: 0,     // процент правильных ответов
            fail: 0,        // количество неправильных ответов
            errors: [],      // массив ошибок
            result: 0,
            speed: 10,
            progress: 0,
        },
        methods: {
            reload() {
                this.getAsset()
            },
            getAsset() {
                this.cards = cards.slice()
                this.loading = true;
                this.quantity = this.cards.length
                this.translates = []
                this.success = 0
                this.answers = 0
                this.errors = []
                this.percent = 0
                this.cards.forEach((el) => {
                    this.translates.push(el.value)
                })
                this.progress = 0
                this.createTest()
                this.result = 0
                this.error = false
            },
            check(variant) {
                this.answers++
                this.progress = (Math.floor((this.answers * 100) / this.quantity))
                if (variant.correct) {
                    this.error = false
                    this.success++
                    this.percent = Math.floor((this.success * 100) / this.quantity)
                    this.next()
                } else {
                    this.error = true
                    this.fail++
                    this.errors.push(this.question) // todo: use store
                    this.next()
                    return
                }

            },
            next() {
                if (this.cards.length > 0)
                    this.createTest()
                else {
                    this.question = {}
                    this.variants = []
                    this.progress = 100
                    var self = this;
                    setTimeout(function () {
                        self.result = self.success
                    }, 1000);
                }
            },
            createTest() {
                this.question = this.cards.pop()
                this.variants = [{'text': this.question.value, 'correct': true}]
                let indexes = []
                let translates = this.translates.slice()
                translates.remove(this.question.value)

                while (this.variants.length < ((this.quantity > 4) ? 4 : this.quantity)) {
                    let l = Math.floor(Math.random() * translates.length)

                    if (indexes.indexOf(l) != -1)
                        continue

                    indexes.push(l)

                    this.variants.push({'text': translates[l], 'correct': false})
                }

                this.variants.shuffle()
            }
        },
        created: function () {
            this.getAsset()
        },
    })

    new Vue({
        el: '#text_view',

        data: {
            text: {
                'computed': '',
                'created_at': '',
                'updated_at': '',
                'id': 0,
                'published': 1,
                'text': '',
                'text_extra': [],
                'title': '',
                'words_count': 0,
            },
            dictionary: {},
            input: '',
            inputWords: [],
            showedExtra: '',
            showSuccess: false,
            progress: 0,
            nextTextId: 0,
            dictionaryLength: 0
        },
        computed: {
            output() {
                let c = 0;
                let origs = []
                this.dictionaryLength = this.dictionary.length;
                this.text.computed = this.text.text

                this.inputWords.forEach((el) => {
                    el = el.toLowerCase()
                    if (el !== '' && el in this.dictionary)
                        origs = origs.concat(this.dictionary[el].map((item) => {
                            return item = item + '|' + el
                        }))
                })

                origs = origs.filter((v, i, a) => a.indexOf(v) === i)

                for (let i = 0; i < origs.length; i++) {
                    let arr = origs[i].split('|')
                    let word = arr[0].replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&")
                    let tooltip = arr[1]

                    var re = new RegExp("(^|\\s)(" + word.trim() + ")([^\\w]|$)", 'gi');
                    let result = this.text.computed.match(re);

                    this.text.computed = this.text.computed.replace(
                        re, '$1<span class="success-text" tooltip=' + tooltip + '>$2</span>$3'
                    );

                    if (result)
                        c += (word.split(' ').length) * result.length
                    else
                        c += word.split(' ').length
                }

                if (this.showedExtra !== '') {
                    this.text.computed = this.text.computed.replace(
                        new RegExp("(^|\\s|>)(" + this.showedExtra.trim() + ")([^\\w]|$|<)", 'gi'),
                        '$1<span class="warning-text">$2</span>$3'
                    )
                }

                this.progress = Math.floor((c * 100) / this.text.words_count);

                if (this.progress > 99) this.showSuccess = true

                return this.text.computed
            }
        },
        created() {
            this.loadText()
        },
        methods: {
            loadText() {
                this.clear()
                this.text = JSON.parse(JSON.stringify(text))
                this.text.computed = this.text.text
                this.dictionary = JSON.parse(JSON.stringify(syns))
            },
            separate() {
                this.inputWords = this.input.replace(/\s+/g, " ").replace(/\./g, ' ').replace(/\,/g, '').trim().split(" ");
            },
            showExtra(extra) {
                this.showedExtra = extra.orig
            },
            clearExtra() {
                this.showedExtra = ''
            },
            clear() {
                this.input = ''
                this.inputWords = []
                this.progress = 0
            },
        }
    })

    new Vue({
        el: '#puzzle_view',
        data: {
            translate: 'Вдруг она увидела белого кролика',
            sentence: 'skyndilega hún sá á hvíta kanínu',
            words: [],
            shufflewords: [],
            dropzones: [],
            progress: 0,
            success: 0,
            words_count: 0,
            isRotate: false
        },
        created() {
            this.words = this.sentence.split(" ")
            this.shufflewords = this.sentence.split(" ").shuffle()
            this.words_count = this.words.length

            for (let i = 0; i < this.words.length; i++) {
                this.dropzones.push({
                    'for': this.words[i],
                    'content': [],
                    'class': 'dragover'
                })
            }
        },
        methods: {
            handleDrop(toList, data) {
                const fromList = data.list

                if (data.item === toList.for) {
                    toList.content.push(data.item);
                    fromList.splice(fromList.indexOf(data.item), 1);
                    this.success++
                    this.progress = Math.floor((this.success * 100) / this.words_count)
                } else {
                    toList.class = 'dragover'
                }
            },
            handleBackDrop(toList, data) {
                const fromList = data.list;

                if (data.zone) {
                    toList.push(data.item);
                    fromList.splice(fromList.indexOf(data.item), 1);
                    data.zone.class = 'dragover'
                    this.success--
                    this.progress = Math.floor((this.success * 100) / this.words_count)
                }
            },
            handleDragEnter(ev, data) {
                ev.class = 'dragenter'
            },
            handleDragLeave(ev, data) {
                if (!ev.content.length)
                    ev.class = 'dragover'
            },
            refresh() {
                let self = this
                this.isRotate = true
                this.words = this.sentence.split(" ")
                this.shufflewords = this.sentence.split(" ").shuffle()
                this.dropzones = []
                this.progress = 0
                this.success = 0
                this.words_count = this.words.length

                for (let i = 0; i < this.words.length; i++) {
                    this.dropzones.push({
                        'for': this.words[i],
                        'content': [],
                        'class': 'dragover'
                    })
                }

                setTimeout(function () {
                    self.isRotate = false
                }, 1000)
            }
        }
    })

    $('#slider_view').boxLoader({
        direction: "x",
        position: "5%",
        effect: "fadeIn",
        duration: "1s",
        windowarea: "100%"
    });
    $('#test_view').boxLoader({
        direction: "x",
        position: "-5%",
        effect: "fadeIn",
        duration: "1s",
        windowarea: "100%"
    });
    /* иначе будет баг перетаскивания в хроме
    $('#puzzle_view').boxLoader({
        direction:"x",
        position: "5%",
        effect: "fadeIn",
        duration: "1s",
        windowarea: "100%"
    });
    */
    $('#text_view').boxLoader({
        direction: "x",
        position: "-5%",
        effect: "fadeIn",
        duration: "1s",
        windowarea: "100%"
    });
    $('#mobileview').boxLoader({
        direction: "x",
        position: "5%",
        effect: "fadeIn",
        duration: "1s",
        windowarea: "100%"
    });
    $('.icelandic').boxLoader({
        direction: "y",
        position: "5%",
        effect: "fadeIn",
        duration: "0.3s",
        windowarea: "70%"
    });
    $('.sweden').boxLoader({
        direction: "y",
        position: "10%",
        effect: "fadeIn",
        duration: "0.5s",
        windowarea: "70%"
    });
    $('.norwegian').boxLoader({
        direction: "y",
        position: "15%",
        effect: "fadeIn",
        duration: "0.7s",
        windowarea: "70%"
    });
    $('.finnish').boxLoader({
        direction: "y",
        position: "20%",
        effect: "fadeIn",
        duration: "1s",
        windowarea: "70%"
    });
    $('.p-yel').boxLoader({
        direction: "x",
        position: "-5%",
        effect: "fadeIn",
        duration: "1s",
        windowarea: "70%"
    });
    $('.p-green').boxLoader({
        direction: "y",
        position: "20%",
        effect: "fadeIn",
        duration: "1s",
        windowarea: "70%"
    });
    $('.p-red').boxLoader({
        direction: "y",
        position: "20%",
        effect: "fadeIn",
        duration: "1s",
        windowarea: "70%"
    });
    $('.p-blue').boxLoader({
        direction: "x",
        position: "5%",
        effect: "fadeIn",
        duration: "1s",
        windowarea: "70%"
    });
    $(window).scroll(function () {
        var offset = 255 - $(window).scrollTop();
        $('.intro-message').css('color', 'rgb(' + offset + ', ' + offset + ', ' + offset + ')');
    });
}