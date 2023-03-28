<?php

include 'zerver_entrance.php';

session_start();

// error_reporting(0);

$question_id = $_POST["question_id"];

$cor_param = '';
$inc_param = '';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM created_questions WHERE question_id = '$question_id'");
    $stmt->execute();
  
    // set the resulting array to associative
    $result = $stmt->FetchAll(PDO::FETCH_ASSOC);

    // echo strpos($result[0]["checking_param"], "<&*>");

    for($x = 0; $x < strlen($result[0]["checking_param"]); $x++){
        if(strpos($result[0]["checking_param"], "<&*>") > $x){
            $inc_param .= $result[0]["checking_param"][$x];
        } else {
            $cor_param .= $result[0]["checking_param"][$x];
        }
    }

    $cor_param = array_values(array_filter(explode("<&*>", $cor_param)));
    $inc_param = array_values(array_filter(explode("<&^>", $inc_param)));

    // print_r($cor_param);
    // echo"<br><br>";
    // print_r($inc_param);
    // echo"<br><br>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM student_answers WHERE question_id = '$question_id'");
        $stmt->execute();
      
        // set the resulting array to associative
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        //START OF ALGORITHM
        $text_inputs_arr = array();
        $text_inputs_arr_id = array();
        $incorrector_arr = array();

        for($x = 0; $x < count($cor_param); $x++){
            array_push($text_inputs_arr, $cor_param[$x]);
        }
        for($x = 0; $x < count($inc_param); $x++){
            array_push($incorrector_arr, $inc_param[$x]);
        }

        for($x = 0; $x < count($result); $x++){
            array_push($text_inputs_arr, $result[$x]["answer"]);
            array_push($text_inputs_arr_id, $result[$x]["answer_id"]);
            array_push($incorrector_arr, $result[$x]["answer"]);
        }

        // print_r($text_inputs_arr_id);
        // print_r($text_inputs_arr); 

        //CORRECT AND INCORRECT IS READY TO CHECK THE REST OF ESSAYS
        //IF 0 to 19% then consider absolute wrong and beyond 19% and yet lower 45% will give another chance by the teacher to check it
        //and beyond 60% will have perfect score if generous, if fair measure it accordingly, but some mercy , if strict no mercy.

        //$text_inputs_arr will be measured by $cor_param and $inc_param.         GRAMMARLY list of negation words (not never neither nor barely hardly scarcely seldom rarely no nothing none no one nobody nowhere)
        $negating_words = array('not', 'never', 'neither', 'nor', 'barely', 'hardly', 'scarcely', 'seldom', 'rarely', 'no', 'nothing', 'none', 'nobody', 'nowhere');

        // print_r($negating_words);

        //SETTLED
        // - $text_inputs_arr
        // - $cor_param if have plenty
        // - $inc_param it will only matter once it fully checked to reduce score

        //STEMMING

        $symbols = ["<",">",",",".","-","—","_","+","=","?","/","`","~","[","]","{","}",":",";","'",'"',"!","@","#","$","%","^","&","*","(",")"];

for($y = 0; $y < count($text_inputs_arr); $y++){
    for($i = 0; $i < strlen($text_inputs_arr[$y]); $i++){
        for($x = 0; $x < count($symbols); $x++){
            if($text_inputs_arr[$y][$i] == $symbols[$x]){
                $text_inputs_arr[$y][$i] = " ";
                $x = count($symbols);
            }
        }
    }
}

for($y = 0; $y < count($incorrector_arr); $y++){
    for($i = 0; $i < strlen($incorrector_arr[$y]); $i++){
        for($x = 0; $x < count($symbols); $x++){
            if($incorrector_arr[$y][$i] == $symbols[$x]){
                $incorrector_arr[$y][$i] = " ";
                $x = count($symbols);
            }
        }
    }
}

for($i = 0; $i < count($text_inputs_arr); $i++){
    $text_inputs_arr[$i] = explode(' ', strtolower($text_inputs_arr[$i]));
}

for($i = 0; $i < count($incorrector_arr); $i++){
    $incorrector_arr[$i] = explode(' ', strtolower($incorrector_arr[$i]));
}

$stopwords = ["","0o", "0s", "3a", "3b", "3d", "6b", "6o", "a", "a1", "a2", "a3", "a4", "ab", "able", "about", "above", "abst", "ac", "accordance", "according", "accordingly", "across", "act", "actually", "ad", "added", "adj", "ae", "af", "affected", "affecting", "affects", "after", "afterwards", "ag", "again", "against", "ah", "ain", "ain't", "aj", "al", "all", "allow", "allows", "almost", "alone", "along", "already", "also", "although", "always", "am", "among", "amongst", "amoungst", "amount", "an", "and", "announce", "another", "any", "anybody", "anyhow", "anymore", "anyone", "anything", "anyway", "anyways", "anywhere", "ao", "ap", "apart", "apparently", "appear", "appreciate", "appropriate", "approximately", "ar", "are", "aren", "arent", "aren't", "arise", "around", "as", "a's", "aside", "ask", "asking", "associated", "at", "au", "auth", "av", "available", "aw", "away", "awfully", "ax", "ay", "az", "b", "b1", "b2", "b3", "ba", "back", "bc", "bd", "be", "became", "because", "become", "becomes", "becoming", "been", "before", "beforehand", "begin", "beginning", "beginnings", "begins", "behind", "being", "believe", "below", "beside", "besides", "best", "better", "between", "beyond", "bi", "bill", "biol", "bj", "bk", "bl", "bn", "both", "bottom", "bp", "br", "brief", "briefly", "bs", "bt", "bu", "but", "bx", "by", "c", "c1", "c2", "c3", "ca", "call", "came", "can", "cannot", "cant", "can't", "cause", "causes", "cc", "cd", "ce", "certain", "certainly", "cf", "cg", "ch", "changes", "ci", "cit", "cj", "cl", "clearly", "cm", "c'mon", "cn", "co", "com", "come", "comes", "con", "concerning", "consequently", "consider", "considering", "contain", "containing", "contains", "corresponding", "could", "couldn", "couldnt", "couldn't", "course", "cp", "cq", "cr", "cry", "cs", "c's", "ct", "cu", "currently", "cv", "cx", "cy", "cz", "d", "d2", "da", "date", "dc", "dd", "de", "definitely", "describe", "described", "despite", "detail", "df", "di", "did", "didn", "didn't", "different", "dj", "dk", "dl", "do", "does", "doesn", "doesn't", "doing", "don", "done", "don't", "down", "downwards", "dp", "dr", "ds", "dt", "du", "due", "during", "dx", "dy", "e", "e2", "e3", "ea", "each", "ec", "ed", "edu", "ee", "ef", "effect", "eg", "ei", "eight", "eighty", "either", "ej", "el", "eleven", "else", "elsewhere", "em", "empty", "en", "end", "ending", "enough", "entirely", "eo", "ep", "eq", "er", "es", "especially", "est", "et", "et-al", "etc", "eu", "ev", "even", "ever", "every", "everybody", "everyone", "everything", "everywhere", "ex", "exactly", "example", "except", "ey", "f", "f2", "fa", "far", "fc", "few", "ff", "fi", "fifteen", "fifth", "fify", "fill", "find", "fire", "first", "five", "fix", "fj", "fl", "fn", "fo", "followed", "following", "follows", "for", "former", "formerly", "forth", "forty", "found", "four", "fr", "from", "front", "fs", "ft", "fu", "full", "further", "furthermore", "fy", "g", "ga", "gave", "ge", "get", "gets", "getting", "gi", "give", "given", "gives", "giving", "gj", "gl", "go", "goes", "going", "gone", "got", "gotten", "gr", "greetings", "gs", "gy", "h", "h2", "h3", "had", "hadn", "hadn't", "happens", "hardly", "has", "hasn", "hasnt", "hasn't", "have", "haven", "haven't", "having", "he", "hed", "he'd", "he'll", "hello", "help", "hence", "her", "here", "hereafter", "hereby", "herein", "heres", "here's", "hereupon", "hers", "herself", "hes", "he's", "hh", "hi", "hid", "him", "himself", "his", "hither", "hj", "ho", "home", "hopefully", "how", "howbeit", "however", "how's", "hr", "hs", "http", "hu", "hundred", "hy", "i", "i2", "i3", "i4", "i6", "i7", "i8", "ia", "ib", "ibid", "ic", "id", "i'd", "ie", "if", "ig", "ignored", "ih", "ii", "ij", "il", "i'll", "im", "i'm", "immediate", "immediately", "importance", "important", "in", "inasmuch", "inc", "indeed", "index", "indicate", "indicated", "indicates", "information", "inner", "insofar", "instead", "interest", "into", "invention", "inward", "io", "ip", "iq", "ir", "is", "isn", "isn't", "it", "itd", "it'd", "it'll", "its", "it's", "itself", "iv", "i've", "ix", "iy", "iz", "j", "jj", "jr", "js", "jt", "ju", "just", "k", "ke", "keep", "keeps", "kept", "kg", "kj", "km", "know", "known", "knows", "ko", "l", "l2", "la", "largely", "last", "lately", "later", "latter", "latterly", "lb", "lc", "le", "least", "les", "less", "lest", "let", "lets", "let's", "lf", "like", "liked", "likely", "line", "little", "lj", "ll", "ll", "ln", "lo", "look", "looking", "looks", "los", "lr", "ls", "lt", "ltd", "m", "m2", "ma", "made", "mainly", "make", "makes", "many", "may", "maybe", "me", "mean", "means", "meantime", "meanwhile", "merely", "mg", "might", "mightn", "mightn't", "mill", "million", "mine", "miss", "ml", "mn", "mo", "more", "moreover", "most", "mostly", "move", "mr", "mrs", "ms", "mt", "mu", "much", "mug", "must", "mustn", "mustn't", "my", "myself", "n", "n2", "na", "name", "namely", "nay", "nc", "nd", "ne", "near", "nearly", "necessarily", "necessary", "need", "needn", "needn't", "needs", "neither", "never", "nevertheless", "new", "next", "ng", "ni", "nine", "ninety", "nj", "nl", "nn", "no", "nobody", "non", "none", "nonetheless", "noone", "nor", "normally", "nos", "not", "noted", "nothing", "novel", "now", "nowhere", "nr", "ns", "nt", "ny", "o", "oa", "ob", "obtain", "obtained", "obviously", "oc", "od", "of", "off", "often", "og", "oh", "oi", "oj", "ok", "okay", "ol", "old", "om", "omitted", "on", "once", "one", "ones", "only", "onto", "oo", "op", "oq", "or", "ord", "os", "ot", "other", "others", "otherwise", "ou", "ought", "our", "ours", "ourselves", "out", "outside", "over", "overall", "ow", "owing", "own", "ox", "oz", "p", "p1", "p2", "p3", "page", "pagecount", "pages", "par", "part", "particular", "particularly", "pas", "past", "pc", "pd", "pe", "per", "perhaps", "pf", "ph", "pi", "pj", "pk", "pl", "placed", "please", "plus", "pm", "pn", "po", "poorly", "possible", "possibly", "potentially", "pp", "pq", "pr", "predominantly", "present", "presumably", "previously", "primarily", "probably", "promptly", "proud", "provides", "ps", "pt", "pu", "put", "py", "q", "qj", "qu", "que", "quickly", "quite", "qv", "r", "r2", "ra", "ran", "rather", "rc", "rd", "re", "readily", "really", "reasonably", "recent", "recently", "ref", "refs", "regarding", "regardless", "regards", "related", "relatively", "research", "research-articl", "respectively", "resulted", "resulting", "results", "rf", "rh", "ri", "right", "rj", "rl", "rm", "rn", "ro", "rq", "rr", "rs", "rt", "ru", "run", "rv", "ry", "s", "s2", "sa", "said", "same", "saw", "say", "saying", "says", "sc", "sd", "se", "sec", "second", "secondly", "section", "see", "seeing", "seem", "seemed", "seeming", "seems", "seen", "self", "selves", "sensible", "sent", "serious", "seriously", "seven", "several", "sf", "shall", "shan", "shan't", "she", "shed", "she'd", "she'll", "shes", "she's", "should", "shouldn", "shouldn't", "should've", "show", "showed", "shown", "showns", "shows", "si", "side", "significant", "significantly", "similar", "similarly", "since", "sincere", "six", "sixty", "sj", "sl", "slightly", "sm", "sn", "so", "some", "somebody", "somehow", "someone", "somethan", "something", "sometime", "sometimes", "somewhat", "somewhere", "soon", "sorry", "sp", "specifically", "specified", "specify", "specifying", "sq", "sr", "ss", "st", "still", "stop", "strongly", "sub", "substantially", "successfully", "such", "sufficiently", "suggest", "sup", "sure", "sy", "system", "sz", "t", "t1", "t2", "t3", "take", "taken", "taking", "tb", "tc", "td", "te", "tell", "ten", "tends", "tf", "th", "than", "thank", "thanks", "thanx", "that", "that'll", "thats", "that's", "that've", "the", "their", "theirs", "them", "themselves", "then", "thence", "there", "thereafter", "thereby", "thered", "therefore", "therein", "there'll", "thereof", "therere", "theres", "there's", "thereto", "thereupon", "there've", "these", "they", "theyd", "they'd", "they'll", "theyre", "they're", "they've", "thickv", "thin", "think", "third", "this", "thorough", "thoroughly", "those", "thou", "though", "thoughh", "thousand", "three", "throug", "through", "throughout", "thru", "thus", "ti", "til", "tip", "tj", "tl", "tm", "tn", "to", "together", "too", "took", "top", "toward", "towards", "tp", "tq", "tr", "tried", "tries", "truly", "try", "trying", "ts", "t's", "tt", "tv", "twelve", "twenty", "twice", "two", "tx", "u", "u201d", "ue", "ui", "uj", "uk", "um", "un", "under", "unfortunately", "unless", "unlike", "unlikely", "until", "unto", "uo", "up", "upon", "ups", "ur", "us", "use", "used", "useful", "usefully", "usefulness", "uses", "using", "usually", "ut", "v", "va", "value", "various", "vd", "ve", "ve", "very", "via", "viz", "vj", "vo", "vol", "vols", "volumtype", "vq", "vs", "vt", "vu", "w", "wa", "want", "wants", "was", "wasn", "wasnt", "wasn't", "way", "we", "wed", "we'd", "welcome", "well", "we'll", "well-b", "went", "were", "we're", "weren", "werent", "weren't", "we've", "what", "whatever", "what'll", "whats", "what's", "when", "whence", "whenever", "when's", "where", "whereafter", "whereas", "whereby", "wherein", "wheres", "where's", "whereupon", "wherever", "whether", "which", "while", "whim", "whither", "who", "whod", "whoever", "whole", "who'll", "whom", "whomever", "whos", "who's", "whose", "why", "why's", "wi", "widely", "will", "willing", "wish", "with", "within", "without", "wo", "won", "wonder", "wont", "won't", "words", "world", "would", "wouldn", "wouldnt", "wouldn't", "www", "x", "x1", "x2", "x3", "xf", "xi", "xj", "xk", "xl", "xn", "xo", "xs", "xt", "xv", "xx", "y", "y2", "yes", "yet", "yj", "yl", "you", "youd", "you'd", "you'll", "your", "youre", "you're", "yours", "yourself", "yourselves", "you've", "yr", "ys", "yt", "z", "zero", "zi", "zz"];

for($i = 0; $i < count($text_inputs_arr); $i++){
    $text_inputs_arr[$i] = array_merge(array_diff($text_inputs_arr[$i], $stopwords));
}

for($i = 0; $i < count($incorrector_arr); $i++){
    $incorrector_arr[$i] = array_merge(array_diff($incorrector_arr[$i], $stopwords));
}
class Stemmer
{
    /**
     *  Takes a word and returns it reduced to its stem.
     *
     *  Non-alphanumerics and hyphens are removed, except for dots and
	 *  apostrophes, and if the word is less than three characters in
	 *  length, it will be stemmed according to the five-step
     *  Porter stemming algorithm.
     *
     *  Note special cases here: hyphenated words (such as half-life) will
	 *  only have the base after the last hyphen stemmed (so half-life would
	 *  only have "life" subject to stemming). Handles multi-hyphenated
	 *  words, too.
     *
     *  @param string $word Word to reduce
     *  @access public
     *  @return string Stemmed word
     */
    function stem( $word )
    {
        if ( empty($word) ) {
            return false;
        }

        $result = '';

        $word = strtolower($word);

        // Strip punctuation, etc. Keep ' and . for URLs and contractions.
        if ( substr($word, -2) == "'s" ) {
            $word = substr($word, 0, -2);
        }
        $word = preg_replace("/[^a-z0-9'.-]/", '', $word);

        $first = '';
        if ( strpos($word, '-') !== false ) {
            //list($first, $word) = explode('-', $word);
            //$first .= '-';
            $first = substr($word, 0, strrpos($word, '-') + 1); // Grabs hyphen too
            $word = substr($word, strrpos($word, '-') + 1);
        }
        if ( strlen($word) > 2 ) {
            $word = $this->_step_1($word);
            $word = $this->_step_2($word);
            $word = $this->_step_3($word);
            $word = $this->_step_4($word);
            $word = $this->_step_5($word);
        }

        $result = $first . $word;

        return $result;
    }

    /**
     *  Takes a list of words and returns them reduced to their stems.
     *
     *  $words can be either a string or an array. If it is a string, it will
     *  be split into separate words on whitespace, commas, or semicolons. If
     *  an array, it assumes one word per element.
     *
     *  @param mixed $words String or array of word(s) to reduce
     *  @access public
     *  @return array List of word stems
     */
    function stem_list( $words )
    {
        if ( empty($words) ) {
            return false;
        }

        $results = array();

        if ( !is_array($words) ) {
            $words = split("[ ,;\n\r\t]+", trim($words));
        }

        foreach ( $words as $word ) {
            if ( $result = $this->stem($word) ) {
                $results[] = $result;
            }
        }

        return $results;
    }

    /**
     *  Performs the functions of steps 1a and 1b of the Porter Stemming Algorithm.
     *
     *  First, if the word is in plural form, it is reduced to singular form.
     *  Then, any -ed or -ing endings are removed as appropriate, and finally,
     *  words ending in "y" with a vowel in the stem have the "y" changed to "i".
     *
     *  @param string $word Word to reduce
     *  @access private
     *  @return string Reduced word
     */
    function _step_1( $word )
    {
		// Step 1a
		if ( substr($word, -1) == 's' ) {
            if ( substr($word, -4) == 'sses' ) {
                $word = substr($word, 0, -2);
            } elseif ( substr($word, -3) == 'ies' ) {
                $word = substr($word, 0, -2);
            } elseif ( substr($word, -2, 1) != 's' ) {
                // If second-to-last character is not "s"
                $word = substr($word, 0, -1);
            }
        }
		// Step 1b
        if ( substr($word, -3) == 'eed' ) {
			if ($this->count_vc(substr($word, 0, -3)) > 0 ) {
	            // Convert '-eed' to '-ee'
	            $word = substr($word, 0, -1);
			}
        } else {
            if ( preg_match('/([aeiou]|[^aeiou]y).*(ed|ing)$/', $word) ) { // vowel in stem
                // Strip '-ed' or '-ing'
                if ( substr($word, -2) == 'ed' ) {
                    $word = substr($word, 0, -2);
                } else {
                    $word = substr($word, 0, -3);
                }
                if ( substr($word, -2) == 'at' || substr($word, -2) == 'bl' ||
                     substr($word, -2) == 'iz' ) {
                    $word .= 'e';
                } else {
                    $last_char = substr($word, -1, 1);
                    $next_to_last = substr($word, -2, 1);
                    // Strip ending double consonants to single, unless "l", "s" or "z"
                    if ( $this->is_consonant($word, -1) &&
                         $last_char == $next_to_last &&
                         $last_char != 'l' && $last_char != 's' && $last_char != 'z' ) {
                        $word = substr($word, 0, -1);
                    } else {
                        // If VC, and cvc (but not w,x,y at end)
                        if ( $this->count_vc($word) == 1 && $this->_o($word) ) {
                            $word .= 'e';
                        }
                    }
                }
            }
        }
        // Step 1c
        // Turn y into i when another vowel in stem
        if ( preg_match('/([aeiou]|[^aeiou]y).*y$/', $word) ) { // vowel in stem
            $word = substr($word, 0, -1) . 'i';
        }
        return $word;
    }

    /**
     *  Performs the function of step 2 of the Porter Stemming Algorithm.
     *
     *  Step 2 maps double suffixes to single ones when the second-to-last character
     *  matches the given letters. So "-ization" (which is "-ize" plus "-ation"
     *  becomes "-ize". Mapping to a single character occurence speeds up the script
     *  by reducing the number of possible string searches.
     *
     *  Note: for this step (and steps 3 and 4), the algorithm requires that if
     *  a suffix match is found (checks longest first), then the step ends, regardless
     *  if a replacement occurred. Some (or many) implementations simply keep
     *  searching though a list of suffixes, even if one is found.
     *
     *  @param string $word Word to reduce
     *  @access private
     *  @return string Reduced word
     */
    function _step_2( $word )
    {
        switch ( substr($word, -2, 1) ) {
            case 'a':
                if ( $this->_replace($word, 'ational', 'ate', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'tional', 'tion', 0) ) {
                    return $word;
                }
                break;
            case 'c':
                if ( $this->_replace($word, 'enci', 'ence', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'anci', 'ance', 0) ) {
                    return $word;
                }
                break;
            case 'e':
                if ( $this->_replace($word, 'izer', 'ize', 0) ) {
                    return $word;
                }
                break;
            case 'l':
                // This condition is a departure from the original algorithm;
                // I adapted it from the departure in the ANSI-C version.
				if ( $this->_replace($word, 'bli', 'ble', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'alli', 'al', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'entli', 'ent', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'eli', 'e', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'ousli', 'ous', 0) ) {
                    return $word;
                }
                break;
            case 'o':
                if ( $this->_replace($word, 'ization', 'ize', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'isation', 'ize', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'ation', 'ate', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'ator', 'ate', 0) ) {
                    return $word;
                }
                break;
            case 's':
                if ( $this->_replace($word, 'alism', 'al', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'iveness', 'ive', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'fulness', 'ful', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'ousness', 'ous', 0) ) {
                    return $word;
                }
                break;
            case 't':
                if ( $this->_replace($word, 'aliti', 'al', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'iviti', 'ive', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'biliti', 'ble', 0) ) {
                    return $word;
                }
                break;
            case 'g':
                // This condition is a departure from the original algorithm;
                // I adapted it from the departure in the ANSI-C version.
                if ( $this->_replace($word, 'logi', 'log', 0) ) { //*****
                    return $word;
                }
                break;
        }
        return $word;
    }

    /**
     *  Performs the function of step 3 of the Porter Stemming Algorithm.
     *
     *  Step 3 works in a similar stragegy to step 2, though checking the
     *  last character.
     *
     *  @param string $word Word to reduce
     *  @access private
     *  @return string Reduced word
     */
    function _step_3( $word )
    {
        switch ( substr($word, -1) ) {
            case 'e':
                if ( $this->_replace($word, 'icate', 'ic', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'ative', '', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'alize', 'al', 0) ) {
                    return $word;
                }
                break;
            case 'i':
                if ( $this->_replace($word, 'iciti', 'ic', 0) ) {
                    return $word;
                }
                break;
            case 'l':
                if ( $this->_replace($word, 'ical', 'ic', 0) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'ful', '', 0) ) {
                    return $word;
                }
                break;
            case 's':
                if ( $this->_replace($word, 'ness', '', 0) ) {
                    return $word;
                }
                break;
        }
        return $word;
    }

    /**
     *  Performs the function of step 4 of the Porter Stemming Algorithm.
     *
     *  Step 4 works similarly to steps 3 and 2, above, though it removes
     *  the endings in the context of VCVC (vowel-consonant-vowel-consonant
     *  combinations).
     *
     *  @param string $word Word to reduce
     *  @access private
     *  @return string Reduced word
     */
    function _step_4( $word )
    {
        switch ( substr($word, -2, 1) ) {
            case 'a':
                if ( $this->_replace($word, 'al', '', 1) ) {
                    return $word;
                }
                break;
            case 'c':
                if ( $this->_replace($word, 'ance', '', 1) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'ence', '', 1) ) {
                    return $word;
                }
                break;
            case 'e':
                if ( $this->_replace($word, 'er', '', 1) ) {
                    return $word;
                }
                break;
            case 'i':
                if ( $this->_replace($word, 'ic', '', 1) ) {
                    return $word;
                }
                break;
            case 'l':
                if ( $this->_replace($word, 'able', '', 1) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'ible', '', 1) ) {
                    return $word;
                }
                break;
            case 'n':
                if ( $this->_replace($word, 'ant', '', 1) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'ement', '', 1) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'ment', '', 1) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'ent', '', 1) ) {
                    return $word;
                }
                break;
            case 'o':
                // special cases
                if ( substr($word, -4) == 'sion' || substr($word, -4) == 'tion' ) {
                    if ( $this->_replace($word, 'ion', '', 1) ) {
                        return $word;
                    }
                }
                if ( $this->_replace($word, 'ou', '', 1) ) {
                    return $word;
                }
                break;
            case 's':
                if ( $this->_replace($word, 'ism', '', 1) ) {
                    return $word;
                }
                break;
            case 't':
                if ( $this->_replace($word, 'ate', '', 1) ) {
                    return $word;
                }
                if ( $this->_replace($word, 'iti', '', 1) ) {
                    return $word;
                }
                break;
            case 'u':
                if ( $this->_replace($word, 'ous', '', 1) ) {
                    return $word;
                }
                break;
            case 'v':
                if ( $this->_replace($word, 'ive', '', 1) ) {
                    return $word;
                }
                break;
            case 'z':
                if ( $this->_replace($word, 'ize', '', 1) ) {
                    return $word;
                }
                break;
        }
        return $word;
    }

    /**
     *  Performs the function of step 5 of the Porter Stemming Algorithm.
     *
     *  Step 5 removes a final "-e" and changes "-ll" to "-l" in the context
     *  of VCVC (vowel-consonant-vowel-consonant combinations).
     *
     *  @param string $word Word to reduce
     *  @access private
     *  @return string Reduced word
     */
    function _step_5( $word )
    {
        if ( substr($word, -1) == 'e' ) {
            $short = substr($word, 0, -1);
            // Only remove in vcvc context...
            if ( $this->count_vc($short) > 1 ) {
                $word = $short;
            } elseif ( $this->count_vc($short) == 1 && !$this->_o($short) ) {
                $word = $short;
            }
        }
        if ( substr($word, -2) == 'll' ) {
            // Only remove in vcvc context...
            if ( $this->count_vc($word) > 1 ) {
                $word = substr($word, 0, -1);
            }
        }
        return $word;
    }

    /**
     *  Checks that the specified letter (position) in the word is a consonant.
     *
     *  Handy check adapted from the ANSI C program. Regular vowels always return
     *  FALSE, while "y" is a special case: if the prececing character is a vowel,
     *  "y" is a consonant, otherwise it's a vowel.
     *
     *  And, if checking "y" in the first position and the word starts with "yy",
     *  return true even though it's not a legitimate word (it crashes otherwise).
     *
     *  @param string $word Word to check
     *  @param integer $pos Position in the string to check
     *  @access public
     *  @return boolean
     */
    function is_consonant( $word, $pos )
    {
        // Sanity checking $pos
        if ( abs($pos) > strlen($word) ) {
            if ( $pos < 0 ) {
                // Points "too far back" in the string. Set it to beginning.
                $pos = 0;
            } else {
                // Points "too far forward." Set it to end.
                $pos = -1;
            }
        }
        $char = substr($word, $pos, 1);
        switch ( $char ) {
            case 'a':
            case 'e':
            case 'i':
            case 'o':
            case 'u':
                return false;
            case 'y':
                if ( $pos == 0 || strlen($word) == -$pos ) {
                    // Check second letter of word.
                    // If word starts with "yy", return true.
                    if ( substr($word, 1, 1) == 'y' ) {
                        return true;
                    }
                    return !($this->is_consonant($word, 1));
                } else {
                    return !($this->is_consonant($word, $pos - 1));
                }
            default:
                return true;
        }
    }

    /**
     *  Counts (measures) the number of vowel-consonant occurences.
     *
     *  Based on the algorithm; this handy function counts the number of
     *  occurences of vowels (1 or more) followed by consonants (1 or more),
     *  ignoring any beginning consonants or trailing vowels. A legitimate
     *  VC combination counts as 1 (ie. VCVC = 2, VCVCVC = 3, etc.).
     *
     *  @param string $word Word to measure
     *  @access public
     *  @return integer
     */
    function count_vc( $word )
    {
        $m = 0;
        $length = strlen($word);
        $prev_c = false;
        for ( $i = 0; $i < $length; $i++ ) {
            $is_c = $this->is_consonant($word, $i);
            if ( $is_c ) {
                if ( $m > 0 && !$prev_c ) {
                    $m += 0.5;
                }
            } else {
                if ( $prev_c || $m == 0 ) {
                    $m += 0.5;
                }
            }
            $prev_c = $is_c;
        }
        $m = floor($m);
        return $m;
    }

    /**
     *  Checks for a specific consonant-vowel-consonant condition.
     *
     *  This function is named directly from the original algorithm. It
     *  looks the last three characters of the word ending as
     *  consonant-vowel-consonant, with the final consonant NOT being one
     *  of "w", "x" or "y".
     *
     *  @param string $word Word to check
     *  @access private
     *  @return boolean
     */
    function _o( $word )
    {
        if ( strlen($word) >= 3 ) {
            if ( $this->is_consonant($word, -1) && !$this->is_consonant($word, -2) &&
                 $this->is_consonant($word, -3) ) {
		        $last_char = substr($word, -1);
		        if ( $last_char == 'w' || $last_char == 'x' || $last_char == 'y' ) {
		            return false;
		        }
                return true;
            }
        }
        return false;
    }

    /**
     *  Replaces suffix, if found and word measure is a minimum count.
     *
     *  @param string $word Word to check and modify
     *  @param string $suffix Suffix to look for
     *  @param string $replace Suffix replacement
     *  @param integer $m Word measure value that the word must be greater
     *                    than to replace
     *  @access private
     *  @return boolean
     */
    function _replace( &$word, $suffix, $replace, $m = 0 )
    {
        $sl = strlen($suffix);
        if ( substr($word, -$sl) == $suffix ) {
            $short = substr_replace($word, '', -$sl);
            if ( $this->count_vc($short) > $m ) {
                $word = $short . $replace;
            }
            // Found this suffix, doesn't matter if replacement succeeded
            return true;
        }
        return false;
    }
}

$word_input = new Stemmer();

for($i = 0; $i < count($text_inputs_arr); $i++){
    for($x = 0; $x < count($text_inputs_arr[$i]); $x++){
        $text_inputs_arr[$i][$x] = $word_input->stem($text_inputs_arr[$i][$x]);
    }
}

for($i = 0; $i < count($incorrector_arr); $i++){
    for($x = 0; $x < count($incorrector_arr[$i]); $x++){
        $incorrector_arr[$i][$x] = $word_input->stem($incorrector_arr[$i][$x]);
    }
}

// print_r($text_inputs_arr);
// echo "<br><br>";

$mapped_text_inputs_arr = array();
$mapped_incorrector_arr = array();

for($i = 0; $i < count($text_inputs_arr); $i++){
    for($x = 0; $x < count($text_inputs_arr[$i]); $x++){
        array_push($mapped_text_inputs_arr, $text_inputs_arr[$i][$x]);
    }
}

for($i = 0; $i < count($incorrector_arr); $i++){
    for($x = 0; $x < count($incorrector_arr[$i]); $x++){
        array_push($mapped_incorrector_arr, $incorrector_arr[$i][$x]);
    }
}

$mapped_text_inputs_arr = array_merge(array_unique($mapped_text_inputs_arr));
$mapped_incorrector_arr = array_merge(array_unique($mapped_incorrector_arr));

// print_r($mapped_text_inputs_arr);

// print_r($text_inputs_arr);

$text_inputs_coord_arr = array();
$incorrector_coord_arr = array();

for($i = 0; $i < count($text_inputs_arr); $i++){
    $hold_arr = array();
    for($x = 0; $x < count($mapped_text_inputs_arr); $x++){
        array_push($hold_arr, 0);
    }
    for($x = 0; $x < count($text_inputs_arr[$i]); $x++){
        $hold_arr[array_search($text_inputs_arr[$i][$x],$mapped_text_inputs_arr)]++;
    }
    array_push($text_inputs_coord_arr, $hold_arr);
}

for($i = 0; $i < count($incorrector_arr); $i++){
    $hold_arr = array();
    for($x = 0; $x < count($mapped_incorrector_arr); $x++){
        array_push($hold_arr, 0);
    }
    for($x = 0; $x < count($incorrector_arr[$i]); $x++){
        $hold_arr[array_search($incorrector_arr[$i][$x],$mapped_incorrector_arr)]++;
    }
    array_push($incorrector_coord_arr, $hold_arr);
}

// print_r($text_inputs_coord_arr);

$log_inputs_arr = array();
$log_incorr_arr = array();

for($i = 0; $i < count($text_inputs_coord_arr[0]); $i++){
    array_push($log_inputs_arr, 0);
}
for($i = 0; $i < count($incorrector_coord_arr[0]); $i++){
    array_push($log_incorr_arr, 0);
}

for($i = 0; $i < count($text_inputs_coord_arr); $i++){
    for($x = 0; $x < count($text_inputs_coord_arr[$i]); $x++){
        if($text_inputs_coord_arr[$i][$x] != 0){
            $log_inputs_arr[$x]++;
        }
    }
}
for($i = 0; $i < count($incorrector_coord_arr); $i++){
    for($x = 0; $x < count($incorrector_coord_arr[$i]); $x++){
        if($incorrector_coord_arr[$i][$x] != 0){
            $log_incorr_arr[$x]++;
        }
    }
}

for($i = 0; $i < count($log_inputs_arr); $i++){
    $log_inputs_arr[$i] = log10(count($text_inputs_coord_arr) / $log_inputs_arr[$i]);
}
for($i = 0; $i < count($log_incorr_arr); $i++){
    $log_incorr_arr[$i] = log10(count($incorrector_coord_arr) / $log_incorr_arr[$i]);
}

$tfidf_outputs_arr = array();

for($i = 0; $i < count($text_inputs_coord_arr); $i++){
    $hold_arr = array();
    for($x = 0; $x < count($text_inputs_coord_arr[$i]); $x++){
        array_push($hold_arr, $text_inputs_coord_arr[$i][$x] * $log_inputs_arr[$x]);
    }
    array_push($tfidf_outputs_arr, $hold_arr);
}

// print_r($mapped_text_inputs_arr);
// echo '<br><br>';
// print_r($log_inputs_arr);
// echo '<br><br>';
// print_r($tfidf_outputs_arr[0]);
// echo '<br><br>';
// print_r($tfidf_outputs_arr[2]);

        //END STEMMING

function cosine_sim($input1, $input2, $input3){
    $hold_str1 = 0;
    $hold_arr1 = array();
    $hold_str2 = 0;
    $hold_str3 = 0;
    // print_r($input1);
    // echo "<br><br>";
    // print_r($input2);
    for($x = 0; $x < $input3; $x++){
        array_push($hold_arr1, $input1[$x] * $input2[$x]);
    }
    for($x = 0; $x < $input3; $x++){
        $hold_str1 += $hold_arr1[$x];
    }
    // echo $hold_str1;
    for($x = 0; $x < count($input1); $x++){
        $hold_str2 += $input1[$x];
    }
    for($x = 0; $x < count($input2); $x++){
        $hold_str3 += $input2[$x];
    }
    $hold_str2 = sqrt($hold_str2);
    $hold_str3 = sqrt($hold_str3);
    if(($hold_str2 * $hold_str3) == 0){
        return 0;
    }
    return $hold_str1 / ($hold_str2 * $hold_str3);
}

// echo count($text_inputs_coord_arr);
// echo "<br><br>";
// echo cosine_sim($text_inputs_coord_arr[0], $text_inputs_coord_arr[39], count($mapped_text_inputs_arr));

$similarity_output = array();
$similarity_incorr = array();

for($x = count($cor_param); $x < count($text_inputs_coord_arr); $x++){
    $hold_y = 0;
    for($y = 0; $y < count($cor_param); $y++){
        if(cosine_sim($text_inputs_coord_arr[$y], $text_inputs_coord_arr[$x], count($mapped_text_inputs_arr)) > $hold_y){
            $hold_y = cosine_sim($text_inputs_coord_arr[$y], $text_inputs_coord_arr[$x], count($mapped_text_inputs_arr));
        }
    }
    array_push($similarity_output, $hold_y);
}

for($x = count($inc_param); $x < count($incorrector_coord_arr); $x++){
    $hold_y = 0;
    for($y = 0; $y < count($inc_param); $y++){
        if(cosine_sim($incorrector_coord_arr[$y], $incorrector_coord_arr[$x], count($mapped_incorrector_arr)) > $hold_y){
            $hold_y = cosine_sim($incorrector_coord_arr[$y], $incorrector_coord_arr[$x], count($mapped_incorrector_arr));
        }
    }
    array_push($similarity_incorr, $hold_y);
}

// print_r($similarity_output);

$outcome_arr = array();
$incorre_arr = array();

for($x = 0; $x < count($similarity_output); $x++){
    if($similarity_output[$x] * 100 > 59){
        array_push($outcome_arr, "NEXT_STEP");
    }
    else if($similarity_output[$x] * 100 > 19 && $similarity_output[$x] * 100 < 60){
        array_push($outcome_arr, "WILDCARD");
    } else {
        array_push($outcome_arr, "FAILED");
    }
}

for($x = 0; $x < count($similarity_incorr); $x++){
    if($similarity_incorr[$x] * 100 > 59){
        array_push($incorre_arr, "DEDUCT");
    }
    else {
        array_push($incorre_arr, "NONE");
    }
}
echo "<br><br>";
print_r($outcome_arr);
echo "<br><br>";
print_r($incorre_arr);
echo "<br><br>";
print_r($text_inputs_arr_id);

//JUST NEEDED to implement the incorrect parameters
// echo "<br><br>";
// print_r($mapped_text_inputs_arr);
// echo "<br><br>";
// print_r($text_inputs_coord_arr);
// echo "<br><br>";
// print_r($incorrector_coord_arr);

$parameterized_items = array();

for($x = 0; $x < count($text_inputs_arr_id); $x++){ //-1 from db system confidence means no event.
    if($outcome_arr[$x] == "FAILED"){
        array_push($parameterized_items, "0"); //just plain failed zero
    } else if ($outcome_arr[$x] == "NEXT_STEP" && $incorre_arr[$x] == "NONE"){
        array_push($parameterized_items, "1"); //just grade it to maximum availablility score.
    } else if ($outcome_arr[$x] == "NEXT_STEP" && $incorre_arr[$x] == "DEDUCT"){
        array_push($parameterized_items, "2"); //grade with deduction.
    } else if ($outcome_arr[$x] == "WILDCARD"){
        array_push($parameterized_items, "3"); //teacher will grade it manually.
    }
}
echo "<br><br>";
print_r($parameterized_items);

$rounded_similarities = array();
$rounded_simila_incor = array();

for($x = 0; $x < count($similarity_output); $x++){
    array_push($rounded_similarities, round((float) $similarity_output[$x] * 100, 2));
}
for($x = 0; $x < count($similarity_incorr); $x++){
    array_push($rounded_simila_incor, round((float) $similarity_incorr[$x] * 100, 2));
}

echo "<br><br>";
print_r($rounded_similarities);
echo "<br><br>";
print_r($rounded_simila_incor);

$final_scores_arr = array();

for($x = 0; $x < count($rounded_similarities); $x++){
    if($incorre_arr[$x] == "DEDUCT"){
        if(($rounded_similarities[$x] - round((float) $incorre_arr[$x], 2)) > 100){
            array_push($final_scores_arr, 100);
        } else {
            array_push($final_scores_arr, $rounded_similarities[$x] - round((float) $incorre_arr[$x], 2));
        }
    } else {
        if($rounded_similarities[$x] > 100){
            array_push($final_scores_arr, 100);
        } else{
            array_push($final_scores_arr, $rounded_similarities[$x]);
        }
    }
}

echo "<br><br>";
print_r($final_scores_arr);
echo "<br><br>";

// $read = "";
// for($x = 0; $x < count($text_inputs_arr[13]); $x++){
//     $read .= $text_inputs_arr[13][$x]." ";
// }
// echo $read;


for($x = 0; $x < count($final_scores_arr); $x++){
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        $sql = "UPDATE student_answers SET grades = ".$final_scores_arr[$x].", checked = 2, system_confidence = ".$parameterized_items[$x]." WHERE answer_id = '".$text_inputs_arr_id[$x]."' AND checked = '0'";
      
        // Prepare statement
        $stmt = $conn->prepare($sql);
      
        // execute the query
        $stmt->execute();
      
        // echo a message to say the UPDATE succeeded
        echo "UPDATED successfully";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}


    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }


} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;

?>