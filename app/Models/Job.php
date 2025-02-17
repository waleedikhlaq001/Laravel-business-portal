<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Job extends Model
{
    use HasFactory;
    use SoftDeletes;

    const APPROVED = 1;
    const AWARDED = 1;
    const COMPLETED = 1;
    const UNCOMPLETED = 0;
    const NOTAWARDED = 0;
    const PENDING = 0;
    const FLAGGED = 2;
    const UNVERIFIEDEMAIL = 3;
    //TO BE MOVED TO A DATABASE
    // const ABUSIVE_WORDS = ['ass','shit', 'black', 'sex', 'bitch', 'fuck', 'fucker', 'pussy', 'bastard', 'yourFather','dick','pussy','bastard','cunt', 'motherfucker','fucker','slut','badbitch','simp','whore','dickhead','nigga','gay','lesbian','cock','cocksucker','mothersucker','sucker','gypsy','sexslave','tits']; //a better data bank.
    const ABUSIVE_WORDS = ["100% natural", "100% quality guaranteed", "Acquired Immune Deficiency Syndrome", "ADD", "added value", "ADHD", "AIDS", "All Natural", "ALS", "Alzheimers", "Antibacterial", "Anti-bacterial", "antifungal", "Anti-Fungal", "Anti-Microbial", "anxiety", "approved", "Arrive faster", "Attention Deficit Disorder Drug", "Authentic", "award winning", "bacteria", "best deal", "Best price", "Best seller", "Best selling", "big sale", "biodegradable", "biological contaminants", "bpa free", "brand new", "buy now", "buy with confidence", "Cancer", "Cancroid", "Cataract", "cataract", "certified", "Chlamydia", "closeout", "close-out", "CMV", "compostable", "Concusuion", "Coronavirus", "covid", "COVID-19", "Crabs", "Crystic Fibrosis", "cure", "Cytomegalovirus", "decomposable", "degradable", "Dementia", "Depression", "detoxification", "detoxify", "Diabetes", "Diabetic", "Diabetic Neuropathy", "Discounted price", "disease", "diseases", "don’t miss out", "dotoxifying", "eco friendly", "ecofriendly", "eco-friendly", "environmentally friendly", "etc.", "fall sale", "fda", "FDA Approval", "FedEx", "filter", "flawless", "Flu", "free gift", "free shipping", "Free shipping Guaranteed", "fungal", "Fungicide", "Fungicides", "fungus", "gift idea", "Glaucoma", "Gororrhea", "Great as", "Great for", "green", "guarantee", "guaranteed", "Hassle free", "heal", "Hepatitis A", "Hepatitis B", "Hepatitis C", "Herpes", "Herpes Simplex Virus 1", "Herpes Simplex Virus 2", "highest rated", "HIV", "Hodgkins Lymphoma", "home compostable", "hot item", "HPV", "HSV1", "HSV2", "huge sale", "Human Immunodeficiency Virus", "Human Papiloma Virus", "imported from", "indian", "inflammation", "Influenza", "Kidney Disease", "Lasting quality", "LGV", "limited time offer", "Liver disease", "Lupus", "Lymphogranuloma Venereum", "Lymphoma", "Made in", "mail rebate", "make excellent", "makes awesome", "makes great", "makes perfect", "makes spectacular", "makes the best", "makes wonderful", "marine degradable", "massive sale", "Meningitis", "mildew", "money back guarantee", "Mono", "Mononucleosis", "mould", "mould resistant", "mould spores", "Multiple Sclerosis", "multiple sclerosis", "Muscular Dystrophy", "Mycoplasma Genitalium", "Nano Silver", "native american", "Native American Indian or tribes", "natural", "newest version", "NGU", "non toxic", "noncorrosive", "Nongonococcal Urethritis", "non-toxi", "non-toxic", "now together", "On sale", "over- stock", "overstock", "parasitic", "Parkinson", "Parkinsons", "parkinsons", "patented", "peal", "Pelvic Inflammatory Disease", "Perfect for", "Perfect gift", "pesticide", "pesticides", "PID", "platinum", "plus free", "Professional quality", "proven", "Public lice", "quality", "Ready to ship", "recommended by", "remedies", "remedy", "Retail box", "SAD", "sad", "sanitize", "sanitizes", "Satisfaction", "Save $", "Save cash", "Save money", "scabies", "Seasonal Affective Disorder", "seen on tv", "Ships faster", "shop with confidence", "Special offer", "Special promo", "spring sale", "Stroke", "stroke", "summer sale", "super sale", "supplies won’t last", "TBIs", "tbis", "tested", "tested", "The Clap", "the clap", "Top notch", "top quality", "top rated", "top selling", "toxic", "toxin", "toxins", "Traumatic Brain Injuries", "treat", "treatment", "tribes", "Trich", "trichomoniasis", "tricht", "Tumor", "unbeatable price", "UPS", "Used", "validated", "viral", "virus", "viruses", "weight loss", "wholesale price", "winter sale", "Within hours", "worlds best", "original", "Next day delivery", "Next day shipment", "Free Installation", "Follow Come", "Konga", "Shop Konga", "Imported", "Express Delivery", "Indestructable", "No Returns", "Fairly used", "Brand new", "deal dey", "Key features", "SKU", "Product line", "Where to use", "Indestructible", "5h1t", "5hit", "a55", "ar5e", "arrse", "arse", "ass", "ass-fucker", "asses", "assfucker", "assfukka", "asshole", "assholes", "asswhole", "a_s_s", "b!tch", "b00bs", "b17ch", "b1tch", "ballbag", "ballsack", "bastard", "beastial", "beastiality", "bellend", "bestial", "bestiality", "bi+ch", "biatch", "bitch", "bitcher", "bitchers", "bitches", "bitching", "boiolas", "bollock", "bollok", "boner", "boobs", "boob", "buceta", "bugger", "bum", "bunny fucker", "butt", "butthole", "buttmuch", "buttplug", "c0ck", "c0cksucker", "carpet muncher", "cawk", "chink", "cipa", "cl1t", "clit", "clits", "cnut", "cock", "cock-sucker", "cockface", "cockhead", "cockmunch", "cockmuncher", "cocks", "cocksuck", "cocksucked", "cocksucker", "cocksucking", "cocksucks", "cocksuka", "cocksukka", "cok", "cokmuncher", "coksucka", "coon", "cox", "crap", "cum", "cummer", "cumming", "cums", "cumshot", "cunt", "cuntlick", "cuntlicker", "cuntlicking", "cunts", "cyalis", "cyberfuc", "cyberfuck", "cyberfucked", "cyberfucker", "cyberfuckers", "cyberfucking", "d1ck", "damn", "dick", "dickhead", "dink", "dinks", "dirsa", "dlck", "dog-fucker", "doggin", "dogging", "donkeyribber", "doosh", "duche", "dyke", "Preowned", "Pre-Owned", "rooted", "shit", "pussy", "Chanel", "Hermes", "Guerlain", "Saint Laurent", "Berluti", "Louis Vuitton", "Acne Studios", "Balmain", "Isabel Marant", "bio-oil", "bio oil", "Urban Decay", "wahl", "gucci", "My Ride 65", "Ride 65", "Tag Heuer", "tom ford", "UK Used", "UK Neatly Used", "Neatly Used", "MAC", "Bobbi Brown", "Rubik Cube", "Rubiks Cube", "Rubiks", "Rubic", "Rubics", "Rubic’s", "Rubic Cube", "Rubics Cube", "Rubic’s Cube", "Ben Nye", "Ban Nye", "tomford", "Soundlink", "Sound Link", "beoplay", "beo play", "Sollatek", "Yeezy", "Sebamed", "Seba Med", "fuck", "www.aliexpress.com", "refurbished", "reconditioned", "UrbanDecay", "Unlocked Mifi", "Unlocked MTN Mifi", "Rolex", "60000mah", "60,000mah", "60000 mah", "60,000 mah", "70000mah", "70,000mah", "70000 mah", "70,000 mah", "80000mah", "80,000mah", "80000 mah", "80,000 mah", "90000mah", "90,000mah", "90000 mah", "90,000 mah", "100000mah", "100,000mah", "100000 mah", "100,000 mah", "110000mah", "110,000mah", "110000 mah", "110,000 mah", "120000mah", "120,000mah", "120000 mah", "120,000 mah", "65000mah", "65,000mah", "65000 mah", "65,000 mah", "72000mah", "72,000mah", "72000 mah", "72,000 mah", "85000mah", "85,000mah", "85000 mah", "85,000 mah", "95000mah", "95,000mah", "95000 mah", "95,000 mah", "London Used", "Unboxed", "Ray Ban", "Rayban", "G-Shock", "Armani", "Anya Hindmarch", "spy", "Unlocked", "Speedo", "bose", "hublot", "swatch", "Rubik’s", "Rubik’s Cube", "Rubik", "Givenchy", "Versace", "vigrx", "vigrx plus", "tobaco", "tobacco", "shisha", "hookah", "Oriflame", "Yezzy", "Tissot", "100% Human Hair", "vicomma", "shop vicomma", "buy vicomma", "Konga", "Shop Konga"];
    protected $fillable = [
        'name',
        'description',
        'payment_id',
        'status',
        'attachment_id',
        'currency_id',
        'budget_id',
        'video_content_id',
        'vendor_id',
        'influencer_id',
        'isApproved',
        'isAwarded',
        'type',
        'experience_level'
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public function attachment()
    {
        return $this->hasMany(Attachment::class);
    }

    public function milestone()
    {
        return $this->hasMany(Milestone::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function walletTransaction()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
    public function payment()
    {
        return $this->belongsTo(FixedPayment::class);
    }

    public function video()
    {
        return $this->hasOne(VideoContent::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function influencer()
    {
        return $this->belongsTo(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'influencer_id');
    }

    public function dispute()
    {
        return $this->hasOne(Dispute::class);
    }
}
